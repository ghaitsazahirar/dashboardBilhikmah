<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class BerandaSholatController extends Controller
{
    private function getCookies(): CookieJar
    {
        $response = Http::get('https://bimasislam.kemenag.go.id/jadwalshalat');

        return $response->cookies();
    }

    public function getProvinsi()
    {
        $response = Http::withOptions([
                'cookies' => $this->getCookies()
            ])
            ->get('https://bimasislam.kemenag.go.id/jadwalshalat');

        $provinsi = [];

        (new Crawler($response->body()))
            ->filter('#search_prov option')
            ->each(function (Crawler $node) use (&$provinsi) {
                if ($node->text() != 'PUSAT') {
                    $provinsi[] = [
                        'value' => $node->attr('value'),
                        'text' => $node->text(),
                    ];
                }
            });

        return response()->json($provinsi);
    }

    public function getKabupatenKota(Request $request)
    {
        $validated = $request->validate([
            'provinsi_id' => ['required', 'string'],
        ]);

        $response = Http::withOptions([
                'cookies' => $this->getCookies()
            ])
            ->asForm()
            ->post('https://bimasislam.kemenag.go.id/ajax/getKabkoshalat', [
                'x' => urlencode($validated['provinsi_id']),
            ]);

        $kabkot = [];

        (new Crawler($response->body()))
            ->filter('option')
            ->each(function (Crawler $node) use (&$kabkot) {
                $kabkot[] = [
                    'value' => $node->attr('value'),
                    'text' => $node->text(),
                ];
            });

        return response()->json($kabkot);
    }

    public function getJadwalShalat(Request $request)
    {
        $validated = $request->validate([
            'provinsi_id' => ['required', 'string'],
            'kabupaten_kota_id' => ['required', 'string'],
            'bulan' => ['required', 'numeric', 'between:1,12'],
            'tahun' => ['required', 'numeric', 'digits:4']
        ]);

        $response = Http::withOptions([
                'cookies' => $this->getCookies()
            ])
            ->asForm()
            ->post('https://bimasislam.kemenag.go.id/ajax/getShalatbln', [
                'x' => urlencode($validated['provinsi_id']),
                'y' => urlencode($validated['kabupaten_kota_id']),
                'bln' => $validated['bulan'],
                'thn' => $validated['tahun'],
            ]);

        return response()->json($response->json());
    }
}
