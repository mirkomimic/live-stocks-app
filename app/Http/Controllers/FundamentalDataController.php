<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\UserNotification;
use App\Services\AlphaVantageApi\FundamentalData\FundamentalData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Inertia\Inertia;

class FundamentalDataController extends Controller
{
  public function __construct(
    protected FundamentalData $fundamentalData,
  ) {
  }

  public function earnings(Request $request)
  {
    $earnings = $this->fundamentalData->earnings($request);

    // if (Auth::check()) {
    //   Notification::send(Auth::user(), new UserNotification('test notification'));
    // }

    return Inertia::render('Data/Earnings', [
      'earnings' => $earnings,
      'filters' => $request->toArray()
    ]);
  }

  public function testNotification(Request $request)
  {
    if (Auth::check()) {
      // $user = User::find(Auth::id());

      // $request->user()->notify(new UserNotification('Hello World! I am a notification 😄'));

      Notification::send(Auth::user(), new UserNotification('test notification'));
    }
  }
}
