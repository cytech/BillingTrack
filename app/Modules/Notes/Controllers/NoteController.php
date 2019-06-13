<?php

/**
 * This file is part of BillingTrack.
 *
 *
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BT\Modules\Notes\Controllers;

use BT\Events\NoteCreated;
use BT\Http\Controllers\Controller;
use BT\Modules\Notes\Models\Note;

class NoteController extends Controller
{
    public function create()
    {
        $model = request('model');

        $object = $model::find(request('model_id'));

        $object->notes()->create(['note' => request('note'), 'user_id' => auth()->user()->id, 'private' => request('isPrivate')]);

        return view('notes._notes_list')
            ->with('object', $object)
            ->with('showPrivateCheckbox', request('showPrivateCheckbox'));
    }

    public function delete()
    {
        Note::destroy(request('id'));
    }
}
