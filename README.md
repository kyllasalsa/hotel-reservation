# Dokumentasi API BookingService

layanan ini bertanggung jawab untuk mengelola data ruangan (room) serta mengkonsumsi data dari layanan BookingService untuk menampilkan histori booking setiap ruangan.

## Base URL

http://localhost:8003

---

## 📂 Endpoints

### 🔹 1. Get All Bookings

**Request:**
GET /api/bookings

**Deskripsi:**
Endpoint untuk menampilkan keseluruhan data booking

**Deskripsi:**

```json
[
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
```

---

### 🔹 2. Get Booking By ID

**Request:**
GET /api/bookings/{id}

**Deskripsi:**
Endpoint untuk menampilkan data lengkap booking berdasarkan ID, beserta detail customer dan detail room yang didapat dengan consume data dari CustomerService dan RoomService.

**Deskripsi:**

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

---

### 🔹 3. Add Booking Data

**Request:**
POST /api/bookings

**Deskripsi:**
Endpoint untuk menambah data booking baru

**body**

```json
{
	"customer_id": "1",
	"room_id": "1",
	"check_in_date": "2025-04-30",
	"check_out_date": "2025-05-02"
}
```

**Deskripsi:**

```json
{
	"customer_id": "1",
	"room_id": "1",
	"check_in_date": "2025-04-30",
	"check_out_date": "2025-05-02",
	"updated_at": "2025-04-30T02:03:15.000000Z",
	"created_at": "2025-04-30T02:03:15.000000Z",
	"id": 1
}
```

---

### 🔹 4. Update Booking Data

**Request:**
PUT /api/bookings/{id}

**Deskripsi:**
Endpoint untuk update booking data berdasarkan ID

**body**

```json
{
	"customer_id": "1",
	"room_id": "1",
	"check_in_date": "2025-04-30",
	"check_out_date": "2025-05-02"
}
```

**Deskripsi:**

```json
{
	"id": 1,
	"customer_id": "1",
	"room_id": "1",
	"check_in_date": "2025-04-30",
	"check_out_date": "2025-05-02",
	"created_at": "2025-04-30T02:03:15.000000Z",
	"updated_at": "2025-04-30T02:03:15.000000Z"
}
```

---

### 🔹 5. Delete Booking Data

**Request:**
DELETE /api/bookings/{id}

**Deskripsi:**
Endpoint untuk hapus booking data berdasarkan ID

**Deskripsi:**

```json
{
	"message": "Booking deleted"
}
```

---
