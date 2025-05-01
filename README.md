# 📡 Dokumentasi Komunikasi Antar Layanan - Hotel Reservation System

## Overview

Sistem ini terdiri dari tiga layanan terpisah yang saling berkomunikasi langsung. Setiap service berperan sebagai provider dan/atau consumer menggunakan protokol HTTP dan format data JSON.

### Layanan yang Terlibat

- **CustomerService (Port: 8001)**
- **RoomService (Port: 8002)**
- **BookingService (Port: 8003)**

---

## Alur Komunikasi Antar Layanan

### 1. CustomerService → BookingService

**Tujuan**: Menampilkan data user beserta daftar bookingnya. CustomerService meng-consume data dari BookingService untuk mendapatkan data booking dari customer tertentu, kemudian menampilkannya bersama dengan data customer.

- **Consumer**: `CustomerService`
- **Provider**: `BookingService`
- **Endpoint**: GET http://localhost:8001/api/customers/booking/{id}
- **Response**:

```json
{
	"id": 1,
	"name": "Customer",
	"email": "customer@gmail.com",
	"bookings": [
		{
			"id": 1,
			"customer_id": 1,
			"room_id": 1,
			"check_in_date": "2025-04-30",
			"check_out_date": "2025-05-02",
			"created_at": "2025-04-30T02:03:15.000000Z",
			"updated_at": "2025-04-30T02:03:15.000000Z"
		}
	]
}
```

### 2. RoomService → BookingService

**Tujuan**: Menampilkan data ruangan beserta daftar riwayat bookingnya. RoomService meng-consume data dari BookingService untuk mendapatkan data booking dari ruangan tersebut, kemudian menampilkannya bersama dengan data room.

- **Consumer**: `RoomService`
- **Provider**: `BookingService`
- **Endpoint**: GET http://localhost:8002/api/rooms/booking/{id}
- **Response**:

```json
{
	"id": 1,
	"room_number": "101",
	"type": "standard",
	"price": 400000,
	"bookings": [
		{
			"id": 1,
			"customer_id": 1,
			"room_id": 1,
			"check_in_date": "2025-04-30",
			"check_out_date": "2025-05-02",
			"created_at": "2025-04-30T02:03:15.000000Z",
			"updated_at": "2025-04-30T02:03:15.000000Z"
		}
	]
}
```

### 3. BookingService → CustomerService & RoomService

**Tujuan**: Menampilkan data lengkap booking berdasarkan ID, beserta detail customer dan detail room yang didapat dengan consume data dari CustomerService dan RoomService.

- **Consumer**: `BookingService`
- **Provider**: `CustomerService` & `RoomService`
- **Endpoint**: GET http://localhost:8003/api/bookings/{id}
- **Response**:

```json
{
	"id": 1,
	"check_in_date": "2025-04-30",
	"check_out_date": "2025-05-02",
	"customer": {
		"name": "Customer",
		"email": "customer@gmail.com",
		"phone": "08123456789"
	},
	"room": {
		"room_number": "101",
		"type": "standard",
		"price": 400000
	}
}
```
