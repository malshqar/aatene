<?php

namespace Modules\Store\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Shared\Http\Responses\ApiResponse;
use Modules\Store\Entities\Story;
use Modules\Store\Events\ReactionOnStory;

class UserStroyController extends Controller
{

    public function index()
    {
        $stores = auth()->user()->followers()->get(['stores.id', 'stores.name']);
        return ApiResponse::success([
            "store" => $stores->makeHidden('pivot')->load('stories')
        ]);
    }

    public function viewStory($storyId)
    {
        $userId = Auth::id();
        $story = Story::findOrFail($storyId);

        $views = $story->views ?? [];
        if (!in_array($userId, $views)) {
            $views[] = $userId;
            $story->views = $views;
            $story->save();
        }
        return ApiResponse::success(message: "Story viewed successfully.");
    }

    public function reactions(Request $request, Story $story)
    {
        $request->validate([
            'reaction_type' => 'required|string',
        ]);

        $userId = Auth::id();
        $reactionType = $request->input('reaction_type');

        $reactions = $story->reactions ?? [];
        $reactions[$userId] = $reactionType;

        $story->reactions = $reactions;

        $story->save();
        ReactionOnStory::dispatch($story,$userId);
        return ApiResponse::success(message: "Reaction saved successfully.");
    }

    public function removeReaction(Request $request, Story $story)
    {
        $userId = Auth::id();
        $reactions = $story->reactions ?? [];
        if (isset($reactions[$userId])) {
            unset($reactions[$userId]);
            $story->reactions = $reactions;
            $story->save();
        }
        return ApiResponse::success(message: "Reaction removed successfully.");
    }


}
