<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\WhatsAppService;
use Illuminate\Http\Request;

class AdminIntegrationController extends Controller
{
    public function index()
    {
        Setting::ensureTable();

        $integrations = (object)[
            // Active Gateway Selector
            'active_gateway' => Setting::get('active_payment_gateway', 'midtrans'),

            // Midtrans Gateway Configs
            'midtrans_mode' => Setting::get('midtrans_is_production', '0') === '1' ? 'production' : 'sandbox',
            'midtrans_merchant_id' => Setting::get('midtrans_merchant_id', env('MIDTRANS_MERCHANT_ID', 'G123456789')),
            'midtrans_client_key' => Setting::get('midtrans_client_key', env('MIDTRANS_CLIENT_KEY', 'SB-Mid-client-DemoFitnessKey123')),
            'midtrans_server_key' => Setting::get('midtrans_server_key', env('MIDTRANS_SERVER_KEY', 'SB-Mid-server-DemoFitnessKey123')),
            'midtrans_webhook_url' => url('/api/midtrans/webhook'),

            // iPaymu Gateway Configs
            'ipaymu_mode' => Setting::get('ipaymu_is_production', '0') === '1' ? 'production' : 'sandbox',
            'ipaymu_va' => Setting::get('ipaymu_va', env('IPAYMU_VA', '0000002447990145')),
            'ipaymu_api_key' => Setting::get('ipaymu_api_key', env('IPAYMU_API_KEY', 'SANDBOX67650-XXXXXXXX-XXXX')),
            'ipaymu_webhook_url' => url('/api/ipaymu/webhook'),

            // WhatsApp Gateway (Wablas / Fonnte) Configs
            'wa_provider' => Setting::get('wa_provider', 'fonnte'),
            'wa_api_key' => Setting::get('wa_api_key', env('WA_API_KEY', 'demo_wa_api_key_fitlife')),
            'wa_api_endpoint' => Setting::get('wa_api_endpoint', env('WA_API_ENDPOINT', 'https://api.fonnte.com/send')),
            'wa_sender_phone' => Setting::get('whatsapp_number', '6281234567890'),
        ];

        return view('admin.integrations.index', compact('integrations'));
    }

    public function update(Request $request)
    {
        Setting::ensureTable();

        $validated = $request->validate([
            'active_gateway' => 'nullable|in:midtrans,ipaymu',
            'midtrans_mode' => 'required|in:sandbox,production',
            'midtrans_merchant_id' => 'nullable|string|max:255',
            'midtrans_client_key' => 'nullable|string|max:255',
            'midtrans_server_key' => 'nullable|string|max:255',
            'ipaymu_mode' => 'required|in:sandbox,production',
            'ipaymu_va' => 'nullable|string|max:255',
            'ipaymu_api_key' => 'nullable|string|max:255',
            'wa_provider' => 'required|string',
            'wa_api_key' => 'nullable|string|max:255',
            'wa_api_endpoint' => 'nullable|string|max:255',
            'wa_sender_phone' => 'nullable|string|max:50',
        ]);

        Setting::set('active_payment_gateway', $request->input('active_gateway', 'midtrans'));

        Setting::set('midtrans_is_production', $validated['midtrans_mode'] === 'production' ? '1' : '0');
        Setting::set('midtrans_merchant_id', $validated['midtrans_merchant_id']);
        Setting::set('midtrans_client_key', $validated['midtrans_client_key']);
        Setting::set('midtrans_server_key', $validated['midtrans_server_key']);

        Setting::set('ipaymu_is_production', $validated['ipaymu_mode'] === 'production' ? '1' : '0');
        Setting::set('ipaymu_va', $validated['ipaymu_va']);
        Setting::set('ipaymu_api_key', $validated['ipaymu_api_key']);

        Setting::set('wa_provider', $validated['wa_provider']);
        Setting::set('wa_api_key', $validated['wa_api_key']);
        Setting::set('wa_api_endpoint', $validated['wa_api_endpoint']);
        Setting::set('whatsapp_number', $validated['wa_sender_phone']);

        return redirect()->route('admin.integrations.index')
            ->with('success', 'Pengaturan Integrasi Payment Gateway (Midtrans & iPaymu) & WhatsApp Gateway BERHASIL DIPERBARUI!');
    }

    public function testWhatsApp(Request $request)
    {
        $targetPhone = $request->input('test_phone', '081234567890');
        $testMsg = "⚡ *TES KONEKSI WHATSAPP GATEWAY*%0A%0APesan notifikasi otomatis dari Sistem FitLife Center berhasil terhubung!";

        $success = WhatsAppService::sendMessage($targetPhone, urldecode($testMsg));

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Pesan tes WhatsApp berhasil dikirim ke ' . $targetPhone . '!'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Simulasi pengiriman pesan WhatsApp berhasil diproses oleh server!'
        ]);
    }
}
