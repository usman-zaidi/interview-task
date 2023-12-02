<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\File;

class ProductTest extends TestCase
{

    public function test_import_the_file_correctly()
    {
        $filename = 'test-file.csv';
        $filePath = public_path($filename);
        $exists = File::exists($filePath);

        $this->assertTrue($exists, "The file $filename does not exist in the public directory.");

    }

    public function test_read_the_file_and_import_file_correctly()
    {

    }

    public function test_check_if_same_sku_already_exists_then_go_for_dispatching_event()
    {

    }

    //Time is up!
}
