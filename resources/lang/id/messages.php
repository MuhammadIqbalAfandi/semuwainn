<?php

return [
    'success' => [
        'store' => [
            'room_booking' => 'Pemesanan berhasil diproses',
            'room' => 'Kamar baru berhasil ditambahkan',
            'restaurant' => 'Hidangan restoran berhasil ditambahkan',
            'service' => 'Layanan berhasil ditambahkan',
            'guest' => 'Data tamu berhasil ditambahkan',
        ],
        'update' => [
            'room' => 'Kamar berhasil diubah',
            'restaurant' => 'Hidangan restaurant berhasil diubah',
            'service' => 'Layanan berhasil diubah',
            'guest' => 'Akun user berhasil diubah',
        ],
        'destroy' => [
            'room' => 'Kamar berhasil dihapus',
            'restaurant' => 'Hidangan restaurant berhasil dihapus',
            'service' => 'Layanan berhasil dihapus',
            'guest' => 'Data Tamu berhasil dihapus',
        ],
    ],
    'error' => [
        'store' => [
            'room_booking' => 'Pemesanan gagal diproses',
        ],
        'destroy' => [
            'all' => 'Gagal menghapus data',
        ],
    ],
];
