# Dokumentasi API CustomerService

layanan ini bertanggung jawab untuk mengelola data pelanggan serta mengkonsumsi data dari layanan BookingService untuk menampilkan histori booking per pelanggan.

## Base URL
http://localhost:8001

---

## 📂 Endpoints

### 🔹 1. Get All Customers

**Request:** 
GET /api/customers

**Deskripsi:**
Menampilkan seluruh data pelanggan yang tersedia.

**Response:**

```json
[
	{
	    "id": 1,
	    "name": "customer1",
	    "email": "customer@gmail.com",
	    "phone": "08123456789",
	    "created_at": "2025-04-27T21:25:53.000000Z",
	    "updated_at": "2025-04-27T21:26:47.000000Z"
    }
]
```

---

### 🔹 2. Get Customer By ID

**Request:** 
GET /api/customers/{id}

**Deskripsi:**
Mengambil data spesifik dari pelanggan berdasarkan ID.

**Response:**

```json
{
	"id":  1,
	"name":  "customer1",
	"email":  "customer@gmail.com",
	"phone":  "08123456789",
	"created_at":  "2025-04-27T21:25:53.000000Z",
	"updated_at":  "2025-04-27T21:26:47.000000Z"
}
```

---

### 🔹 3. Add Customer Data

**Request:** 
POST /api/customers

**Deskripsi:**
Endpoint untuk menambah data customer baru

**body**

```json
{
    "name": "Customer 2",
    "email": "customer2@gmail.com",
    "phone": "08123456789"
}
```

**Response:**

```json
{
	"id":  1,
	"name":  "customer1",
	"email":  "customer@gmail.com",
	"phone":  "08123456789",
	"created_at":  "2025-04-27T21:25:53.000000Z",
	"updated_at":  "2025-04-27T21:26:47.000000Z"
}
```

---

### 🔹 4. Update Customer Data

**Request:** 
PUT /api/customers/{id}

**Deskripsi:**
Endpoint untuk melakukan update data customer

**body**

```json
{
    "name": "Customer 2",
    "email": "customer2@gmail.com",
    "phone": "08123456789"
}
```

**Response:**

```json
{
    "id": 1,
    "name": "Customer2",
    "email": "customer2@gmail.com",
    "phone": "08123456789",
    "created_at": "2025-04-27T21:25:53.000000Z",
    "updated_at": "2025-04-27T21:26:47.000000Z"
}
```

---

### 🔹 5. Delete Customer Data

**Request:** 
DELETE /api/customers/{id}

**Deskripsi:**
Endpoint untuk menghapus data customer

**Response:**

```json
{
    "message": "Customer deleted"
}
```

---

### 🔹 6. Get Customer's Booking

**Request:** 
GET /api/customers/booking/{id}

**Deskripsi:**
Endpoint ini untuk menampilkan data user beserta daftar bookingnya. API meng-consume data dari BookingService untuk mendapatkan data booking dari customer tertentu, kemudian menampilkannya bersama dengan data customer.

**Response:**

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
