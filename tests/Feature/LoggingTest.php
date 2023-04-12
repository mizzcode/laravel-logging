<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class LoggingTest extends TestCase
{
    public function testLogging()
    {
        Log::debug("Jangan Lupa Titik Koma");
        Log::info("Berhasil Login");
        Log::warning("Anda Telah Login Dengan IP yang berbeda");
        Log::error("Register Tidak Bekerja");
        Log::critical("Bug Menyerang");

        self::assertTrue(true);
    }

    public function testContext()
    {
        Log::warning("Anda Telah Login Dengan IP yang berbeda", ['user' => 'mizz']);
        Log::error("Register Tidak Bekerja", ['user' => 'jani']);
        Log::critical("Bug Menyerang", ['user' => 'salman']);

        self::assertTrue(true);
    }

    // untuk context yg sama lebih baik pakai WithContext agar tidak ketik berulang kali
    public function testWithContext()
    {
        Log::withContext(['user' => 'mizz']);
        Log::warning("Anda Telah Login Dengan IP yang berbeda");
        Log::error("Register Tidak Bekerja");
        Log::critical("Bug Menyerang");

        self::assertTrue(true);
    }

    public function testSelectedChannel()
    {
        $slack = Log::channel("slack"); // menentukan channel nya yaitu slack
        $slack->error("Hello Slack"); // ini akan ke channel slack saja

        // berbeda jika kita langsung mengakses dari Log langsung dia akan pakai channel default yaitu stack
        // misalnya
        Log::info("Hello Laravel");

        self::assertTrue(true);
    }

    public function testFileHandler()
    {
        $file = Log::channel("file"); // menentukan channel nya yaitu file
        $file->error("Hello File");
        $file->info("Hello File");
        $file->warning("Hello File");

        self::assertTrue(true);
    }
}
