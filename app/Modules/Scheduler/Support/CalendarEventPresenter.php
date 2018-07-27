<?php

namespace FI\Modules\Scheduler\Support;

use FI\Modules\Scheduler\Models\Category;
use stdClass;

class calendarEventPresenter
{
    public function calendarEvent($entity,$type)
    {

        $data = new stdClass();

        $data->allDay = true;

        switch ($type){
            case 'quote':
                $data->id = ucfirst($type) . ': ' . $entity->number;
                $data->url = url("/quotes/{$entity->id}/edit");
                $data->title = trans("fi.{$type}") . ' ' . $entity->number . ' for ' . $entity->client->name;
                $data->start = $entity->expires_at ?: $entity->quote_date;
                $data->category_id =  (Category::where('name', $type)->value('id'));
                break;
            case 'workorder':
                $data->id = ucfirst($type) . ': ' . $entity->number;
                $data->url = url("/workorders/{$entity->id}/edit");
                $data->title = trans("fi.{$type}") . ' ' . $entity->number . ' for ' . $entity->client->name;
                $data->description = $entity->client->phone . '<br>'
                    . str_replace(array("\r\n", "\r", "\n"), "", $entity->client->address)
                    . '<br>' . $entity->client->city . '<br>' . mb_strimwidth($entity->summary, 0, 50, '...');
                $data->start =  $entity->job_date;
                $data->category_id =  (Category::where('name', $type)->value('id'));
                $data->will_call = $entity->will_call;
                foreach ($entity->workorderItems as $workorderItem){
                    if ($workorderItem->resource_table == 'employees' && $workorderItem->employees->isNotEmpty()) {
                        foreach ($workorderItem->employees as $employee) {
                            if ($employee->driver == 1) {
                                $workorderItem->name = '<span style="color:blue">' . $employee->short_name . '</span>';
                            }
                        }
                    }
                }
                $data->resources = $entity->workorderItems;
                break;
            case 'invoice':
                $data->id = ucfirst($type) . ': ' . $entity->number;
                $data->url = url("/invoices/{$entity->id}/edit");
                $data->title = trans("fi.{$type}") . ' ' . $entity->number . ' for ' . $entity->client->name ;
                $data->start = $entity->due_at ?: $entity->invoice_date;
                $data->category_id =  (Category::where('name', $type)->value('id'));
                break;
            case 'payment':
                $data->id = ucfirst($type) . ': ' . $entity->id;
                $data->url = url("/payments/{$entity->id}");
                $data->title = trans("fi.{$type}") . ' for Invoice ' . $entity->invoice_id ;
                $data->start = $entity->paid_at;
                $data->category_id =  (Category::where('name', $type)->value('id'));
                break;
            case 'expense':
                $data->id = ucfirst($type) . ': ' . $entity->id;
                $data->url = url("/expenses/{$entity->id}/edit");
                $data->title = trans("fi.{$type}") . ' for Category ' . $entity->category->name ;
                $data->start = $entity->expense_date;
                $data->category_id =  (Category::where('name', $type)->value('id'));
                break;
            case 'project':
                $data->id = ucfirst($type) . ': ' . $entity->id;
                $data->url = url("/time_tracking/projects/{$entity->id}/edit");
                $data->title = trans("fi.{$type}") . ' for Client ' . $entity->client->name ;
                $data->start = $entity->due_at;
                $data->category_id =  (Category::where('name', $type)->value('id'));
                break;
            case 'task':
                $data->id = ucfirst($type) . ': ' . $entity->id;
                $data->url = url("/time_tracking/projects/{$entity->time_tracking_project_id}/edit");
                $data->title = trans("fi.{$type}") . ' ' . $entity->name . ' for Project ' . $entity->project->name ;
                $data->start = $entity->timers->first()->start_at;
                $data->category_id =  (Category::where('name', $type)->value('id'));
                break;
            default:

        }


        return $data;
    }
}