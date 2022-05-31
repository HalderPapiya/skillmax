<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\RewordRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use App\Models\Reword;
use App\Http\Controllers\BaseController;

class RewordController extends Controller
{
    // private RewordRepository $rewordRepository;

    // public function __construct(RewordRepository $rewordRepository)
    // {
    //     $this->rewordRepository = $rewordRepository;
    // }


    // /**
    //  * Display a listing of the resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function index()
    // {
    //     $this->setPageTitle('Reward', 'List of all rewards');
    //     $rewords = $this->rewordRepository->getAllRewords();
    //     return view('admin.reword.index', compact('rewords'));
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     $this->setPageTitle('Reward', 'Add reward');
    //     return view('admin.reword.add');
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'time' => 'required',
    //         'amount' => 'required',
    //     ]);

    //     $rewordDetails = $request->except(['_token']);

    //     $reword = $this->rewordRepository->createReword($rewordDetails);

    //     if (!$reword) {
    //         return $this->responseRedirectBack('Error occurred while creating reword.', 'error', true, true);
    //     } else {
    //         return $this->responseRedirect('admin.reword.index', 'Reword has been created successfully', 'success', false, false);
    //     }
    // }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show($id)
    // {
    // }

    // /**
    //  * @param Request $request
    //  * @return \Illuminate\Http\RedirectResponse
    //  * @throws \Illuminate\Validation\ValidationException
    //  */
    // public function updateStatus(Request $request)
    // {

    //     $rewordId = $request->id;
    //     $newDetails = $request->except('_token');

    //     $reword = $this->rewordRepository->updateRewordStatus($rewordId, $newDetails);

    //     if ($reword) {
    //         return response()->json(array('message' => 'Reward status has been successfully updated'));
    //     }
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit($id)
    // {
    //     $targetReword = $this->rewordRepository->getRewordById($id);

    //     $this->setPageTitle('Reward', 'Edit Reward : ' . $targetReword->title);
    //     return view('admin.reword.edit', compact('targetReword'));
    // }

    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function update(Request $request)
    // {
    //     $this->validate($request, [
    //         'time' => 'required',
    //         'amount' => 'required',
    //     ]);

    //     $rewordId = $request->id;
    //     $newDetails = $request->except('_token');

    //     $reword = $this->rewordRepository->updateReword($rewordId, $newDetails);

    //     if (!$reword) {
    //         return $this->responseRedirectBack('Error occurred while updating reword.', 'error', true, true);
    //     } else {
    //         return $this->responseRedirectBack('Reword has been updated successfully', 'success', false, false);
    //     }
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    // public function destroy($id)
    // {
    //     $reword = $this->rewordRepository->deleteReword($id);

    //     if (!$reword) {
    //         return $this->responseRedirectBack('Error occurred while deleting reword.', 'error', true, true);
    //     } else {
    //         return $this->responseRedirect('admin.reword.index', 'updateReword has been deleted successfully', 'success', false, false);
    //     }
    // }
}