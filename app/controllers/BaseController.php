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

}