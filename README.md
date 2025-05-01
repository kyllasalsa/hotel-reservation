# Dokumentasi API RoomService

layanan ini bertanggung jawab untuk mengelola data ruangan (room) serta mengkonsumsi data dari layanan BookingService untuk menampilkan histori booking setiap ruangan.

## Base URL

http://localhost:8002/api

---

## 📂 Endpoints

### 🔹 1. Get All Rooms

**Request:**
GET /api/rooms

**Deskripsi:**
Menampilkan seluruh data ruangan yang tersedia.

**Deskripsi:**

```json
[
	{
		"id": 1,
		"room_number": "101",
		"type": "standard",
		"price": 400000,
		"available": 1,
		"created_at": "2025-04-30T01:43:02.000000Z",
		"updated_at": "2025-04-30T01:43:02.000000Z"
	}
]
```

---

### 🔹 2. Get Room By ID

**Request:**
GET /api/rooms/{id}

**Deskripsi:**
Endpoint untuk menampilkan data room secara spesifik berdasarkan ID

**Deskripsi:**

```json
{
	"id": 1,
	"room_number": "101",
	"type": "standard",
	"price": 400000,
	"available": 1,
	"created_at": "2025-04-30T01:43:02.000000Z",
	"updated_at": "2025-04-30T01:43:02.000000Z"
}
```

---

### 🔹 3. Add Room Data

**Request:**
POST /api/rooms

**Deskripsi:**
Endpoint untuk menambahkan data room baru

**body**

```json
{
	"room_number": "101",
	"type": "standard",
	"price": "400000",
	"available": "1"
}
```

**Deskripsi:**

```json
{
	"room_number": "101",
	"type": "standard",
	"price": "400000",
	"available": "1",
	"updated_at": "2025-04-30T01:43:02.000000Z",
	"created_at": "2025-04-30T01:43:02.000000Z",
	"id": 1
}
```

---

### 🔹 4. Update Room Data

**Request:**
PUT /api/rooms/{id}

**Deskripsi:**
Endpoint untuk melakukan update data room.

**body**

```json
{
	"room_number": "101",
	"type": "standard",
	"price": "400000",
	"available": "1"
}
```

**Deskripsi:**

```json
{
	"id": 1,
	"room_number": "101",
	"type": "standard",
	"price": "400000",
	"available": "1",
	"created_at": "2025-04-30T01:43:02.000000Z",
	"updated_at": "2025-04-30T01:43:02.000000Z"
}
```

---

### 🔹 5. Delete Room Data

**Request:**
DELETE /api/rooms/{id}

**Deskripsi:**
Endpoint untuk menghapus data room

**Deskripsi:**

```json
{
	"message": "Room deleted"
}
```

---

### 🔹 6. Get Room's Booking history

**Request:**
GET /api/rooms/booking/{id}

**Deskripsi:**
Endpoint untuk menampilkan detail dari room, meng-consume data dari BookingService untuk mendapatkan riwayat data bookings dari room tersebut.

**Deskripsi:**

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
