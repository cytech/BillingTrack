<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Reports\Reports;

use BT\Modules\TimeTracking\Models\TimeTrackingProject;
use BT\Support\Statuses\TimeTrackingProjectStatuses;
use BT\Modules\CompanyProfiles\Models\CompanyProfile;
use BT\Support\CurrencyFormatter;
use BT\Support\DateFormatter;
use BT\Support\NumberFormatter;

class TimeTrackingReport
{
    public function getResults($fromDate, $toDate, $companyProfileId = null, $statusId = null)
    {
        $statuses = TimeTrackingProjectStatuses::lists();

        $results = [
            'from_date'       => DateFormatter::format($fromDate),
            'to_date'         => DateFormatter::format($toDate),
            'hours_unbilled'  => 0,
            'hours_billed'    => 0,
            'hours_total'     => 0,
            'amount_unbilled' => 0,
            'amount_billed'   => 0,
            'amount_total'    => 0,
            'projects'        => [],
        ];

        if ($companyProfileId)
        {
            $results['company_profile'] = CompanyProfile::find($companyProfileId)->name;
        }
        else
        {
            $results['company_profile'] = trans('bt.all_company_profiles');
        }

        $projects = TimeTrackingProject::with('client')
            ->companyProfileId($companyProfileId)
            ->statusId($statusId)
            ->whereBetween('created_at', [$fromDate, $toDate])
            ->orderBy('created_at')
            ->get();

        foreach ($projects as $project)
        {
            $results['projects'][$project->id] = [
                'name'            => $project->name,
                'hourly_rate'     => $project->formatted_hourly_rate,
                'client'          => $project->client->name,
                'status'          => $statuses[$project->status_id],
                'hours_unbilled'  => 0,
                'hours_billed'    => 0,
                'hours_total'     => 0,
                'amount_unbilled' => 0,
                'amount_billed'   => 0,
                'amount_total'    => 0,
                'tasks'           => [],
            ];

            foreach ($project->tasks()->getSelect()->get() as $task)
            {
                $results['projects'][$project->id]['tasks'][$task->id] = [
                    'name'   => $task->name,
                    'billed' => $task->billed,
                    'hours'  => NumberFormatter::format($task->hours),
                    'timers' => [],
                ];

                $results['projects'][$project->id]['hours_total']  = $results['hours_total'] += $task->hours;
                $results['projects'][$project->id]['amount_total'] = $results['amount_total'] += $task->hours * $project->hourly_rate;

                if ($task->billed)
                {
                    $results['projects'][$project->id]['hours_billed']  = $results['hours_billed'] += $task->hours;
                    $results['projects'][$project->id]['amount_billed'] = $results['amount_billed'] += $task->hours * $project->hourly_rate;
                }
                else
                {
                    $results['projects'][$project->id]['hours_unbilled']  = $results['hours_unbilled'] += $task->hours;
                    $results['projects'][$project->id]['amount_unbilled'] = $results['amount_unbilled'] += $task->hours * $project->hourly_rate;
                }

                foreach ($task->timers as $timer)
                {
                    $results['projects'][$project->id]['tasks'][$task->id]['timers'][$timer->id] = [
                        'start_at' => $timer->formatted_start_at,
                        'end_at'   => $timer->formatted_end_at,
                        'hours'    => $timer->hours,
                        'amount'   => CurrencyFormatter::format($timer->hours * $project->hourly_rate),
                    ];
                }
            }
        }

        foreach ($results['projects'] as $key => $project)
        {
            $results['projects'][$key]['hours_unbilled']  = NumberFormatter::format($project['hours_unbilled']);
            $results['projects'][$key]['hours_billed']    = NumberFormatter::format($project['hours_billed']);
            $results['projects'][$key]['hours_total']     = NumberFormatter::format($project['hours_total']);
            $results['projects'][$key]['amount_unbilled'] = CurrencyFormatter::format($project['amount_unbilled']);
            $results['projects'][$key]['amount_billed']   = CurrencyFormatter::format($project['amount_billed']);
            $results['projects'][$key]['amount_total']    = CurrencyFormatter::format($project['amount_total']);
        }

        $results['hours_unbilled']  = NumberFormatter::format($results['hours_unbilled']);
        $results['hours_billed']    = NumberFormatter::format($results['hours_billed']);
        $results['hours_total']     = NumberFormatter::format($results['hours_total']);
        $results['amount_unbilled'] = CurrencyFormatter::format($results['amount_unbilled']);
        $results['amount_billed']   = CurrencyFormatter::format($results['amount_billed']);
        $results['amount_total']    = CurrencyFormatter::format($results['amount_total']);

        return $results;
    }
}
