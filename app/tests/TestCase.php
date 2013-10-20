<?php

require_once __DIR__ . '/../../vendor/cordoval/hamcrest-php/hamcrest/Hamcrest.php';
use Way\Tests\Factory;

class TestCase extends Illuminate\Foundation\Testing\TestCase {

    public function setUp() {
        parent::setUp();
        Route::enableFilters();
        Mail::pretend(true);
    }

    public function tearDown() {
        Mockery::close();
    }

	/**
	 * Creates the application.
	 *
	 * @return Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

    protected function prepareDatabase() {
        Artisan::call('migrate');
    }

    protected function dbLogin() {
        $user = Factory::create('User');
        $this->be($user);
        return $user;
    }

    protected function mockLogin() {
        $user = Factory::make('User');
        $this->be($user);
        return $user;
    }

    protected function randomString($nb) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $nb; ++$i) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

}
