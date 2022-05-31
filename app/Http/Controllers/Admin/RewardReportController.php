<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\RewardReportRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\RewardReport;
use App\Http\Controllers\BaseController;

class RewardReportController extends Controller
{
    // private RewardReportRepository $rewardReportRepository;

    // public function __construct(RewardReportRepository $rewardReportRepository)
    // {
    //     $this->rewardReportRepository = $rewardReportRepository;
    // }


    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $this->setPageTitle('Reward Report', 'List of all reward report');
    //     $rewardReports = $this->rewardReportRepository->getAllRewardReports();
    //     return view('admin.reward-report.index', compact('rewardReports'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function create()
    // // {
    // //     $this->setPageTitle('Reword', 'Add reword');
    // //     return view('admin.reword.add');
    // // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function store(Request $request)
    // // {
    // //     $this->validate($request, [
    // //         'time' => 'required',
    // //         'amount' => 'required',
    // //     ]);

    // //     $rewordDetails = $request->except(['_token']);

    // //     $reword = $this->rewordRepository->createReword($rewordDetails);

    // //     if (!$reword) {
    // //         return $this->responseRedirectBack('Error occurred while creating reword.', 'error', true, true);
    // //     } else {
    // //         return $this->responseRedirect('admin.reword.index', 'Reword has been created successfully', 'success', false, false);
    // //     }
    // // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    //     $targetRewardReport = $this->rewardReportRepository->getRewardReportById($id);
    //     // dd($targetRewardReport);

    //     $this->setPageTitle('Reward Report', 'Details Reward Report: ' . $targetRewardReport->title);
    //     return view('admin.reward-report.edit', compact('targetRewardReport'));
    // }

    // /**
    //  * @param Request $request
    //  * @return \Illuminate\Http\RedirectResponse
    //  * @throws \Illuminate\Validation\ValidationException
    //  */
    // // public function updateStatus(Request $request)
    // // {

    // //     $rewordId = $request->id;
    // //     $newDetails = $request->except('_token');

    // //     $reword = $this->rewordRepository->updateRewordStatus($rewordId, $newDetails);

    // //     if ($reword) {
    // //         return response()->json(array('message' => 'Reword status has been successfully updated'));
    // //     }
    // // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function edit($id)
    // // {
    // //     $targetReword = $this->rewordRepository->getRewordById($id);

    // //     $this->setPageTitle('Reword', 'Edit Reword : ' . $targetReword->title);
    // //     return view('admin.reword.edit', compact('targetReword'));
    // // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function update(Request $request)
    // // {
    // //     $this->validate($request, [
    // //         'time' => 'required',
    // //         'amount' => 'required',
    // //     ]);

    // //     $rewordId = $request->id;
    // //     $newDetails = $request->except('_token');

    // //     $reword = $this->rewordRepository->updateReword($rewordId, $newDetails);

    // //     if (!$reword) {
    // //         return $this->responseRedirectBack('Error occurred while updating reword.', 'error', true, true);
    // //     } else {
    // //         return $this->responseRedirectBack('Reword has been updated successfully', 'success', false, false);
    // //     }
    // // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function destroy($id)
    // // {
    // //     $reword = $this->rewordRepository->deleteReword($id);

    // //     if (!$reword) {
    // //         return $this->responseRedirectBack('Error occurred while deleting reword.', 'error', true, true);
    // //     } else {
    // //         return $this->responseRedirect('admin.reword.index', 'updateReword has been deleted successfully', 'success', false, false);
    // //     }
    // // }
}