<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    protected function flashError($message) {
        Session::flash('error', $message);
    }

    protected function flashNotice($message) {
        Session::flash('notice', $message);
    }

    protected function flashSuccess($message) {
        Session::flash('success', $message);
    }

    protected function jsonSuccess($data = null) {
        return Response::json(array('status' => 'success', 'message' => '', 'data' => $data));
    }

    protected function jsonFail($message = 'Server internal error', $data = null) {
        return Response::json(array('status' => 'fail', 'message' => $message, 'data' => $data));
    }

    protected function json($status, $message, $data = null) {
        return Response::json(array('status' => $status, 'message' => $message, 'data' => $data));
    }

}