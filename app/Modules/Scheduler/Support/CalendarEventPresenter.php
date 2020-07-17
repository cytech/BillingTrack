<?php

namespace BT\Modules\Scheduler\Support;

use stdClass;

class CalendarEventPresenter
{
    public function calendarEvent($entity,$type)
    {

        $data = new stdClass();

        $data->allDay = true;

        switch ($type){
            case 'quote':
                $data->id = ucfirst($type) . ': ' . $entity->number;
                $data->url = url("/quotes/{$entity->id}/edit");
                $data->title = trans("bt.{$type}") . ' ' . $entity->number . ' for ' . $entity->client->name;
                $data->description = mb_strimwidth(addslashes($entity->summary), 0, 30, '...');
                $data->start = $entity->expires_at ?: $entity->quote_date;
                $data->category_id = 4;
                break;
            case 'workorder':
                $data->id = ucfirst($type) . ': ' . $entity->number;
                $data->url = url("/workorders/{$entity->id}/edit");
                $data->title = trans("bt.{$type}") . ' ' . $entity->number . ' for ' . $entity->client->name;
                $data->description = $entity->client->phone . '<br>'
                    . str_replace(array("\r\n", "\r", "\n"), "", $entity->client->address)
                    . '<br>' . $entity->client->city . '<br>' . mb_strimwidth(addslashes($entity->summary), 0, 30, '...');
                $data->start = $entity->job_date->copy()->modify($entity->start_time);
                $data->end = $entity->job_date->copy()->modify($entity->end_time);
                $data->category_id =  5;
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
                $data->title = trans("bt.{$type}") . ' ' . $entity->number . ' for ' . $entity->client->name ;
                $data->description = mb_strimwidth(addslashes($entity->summary), 0, 30, '...');
                $data->start = $entity->due_at ?: $entity->invoice_date;
                $data->category_id =  6;
                break;
            case 'payment':
                $data->id = ucfirst($type) . ': ' . $entity->id;
                $data->url = url("/payments/{$entity->id}");
                $data->title = trans("bt.{$type}") . ' for Invoice ' . $entity->invoice_id ;
                $data->description = $entity->paymentMethod->name;
                $data->start = $entity->paid_at;
                $data->category_id =  7;
                break;
            case 'expense':
                $data->id = ucfirst($type) . ': ' . $entity->id;
                $data->url = url("/expenses/{$entity->id}/edit");
                $data->title = trans("bt.{$type}") . ' for Category ' . $entity->category->name ;
                $data->description = $entity->description;
                $data->start = $entity->expense_date;
                $data->category_id =  8;
                break;
            case 'project':
                $data->id = ucfirst($type) . ': ' . $entity->id;
                $data->url = url("/time_tracking/projects/{$entity->id}/edit");
                $data->title = trans("bt.{$type}") . ' for Client ' . $entity->client->name ;
                $data->description = '';
                $data->start = $entity->due_at;
                $data->category_id =  9;
                break;
            case 'task':
                $data->id = ucfirst($type) . ': ' . $entity->id;
                $data->url = url("/time_tracking/projects/{$entity->time_tracking_project_id}/edit");
                $data->title = trans("bt.{$type}") . ' ' . $entity->name . ' for Project ' . $entity->project->name ;
                $data->description = '';
                $data->start = $entity->timers->first()->start_at;
                $data->category_id =  10;
                break;
            case 'purchaseorder':
                $data->id = ucfirst($type) . ': ' . $entity->number;
                $data->url = url("/purchaseorders/{$entity->id}/edit");
                $data->title = trans("bt.{$type}") . ' ' . $entity->number . ' for ' . $entity->vendor->name ;
                $data->description = mb_strimwidth(addslashes($entity->summary), 0, 30, '...');
                $data->start = $entity->due_at ?: $entity->purchaseorder_date;
                $data->category_id =  8;
                break;
            default:

        }


        return $data;
    }
}
