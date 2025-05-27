package com.example.budget

import retrofit2.Call
import retrofit2.http.Body
import retrofit2.http.GET
import retrofit2.http.POST

// Request untuk registrasi
data class RegisterRequest(
    val username: String,
    val email: String,
    val password: String,
    val pekerjaan: String?
)

// Response untuk registrasi
data class RegisterResponse(
    val status: Boolean,
    val message: String,
    val data: UserData?
)

// Request untuk login
data class LoginRequest(
    val email: String,
    val password: String
)

// Request untuk update profile
data class UpdateProfileRequest(
    val username: String,
    val email: String,
    val pekerjaan: String?
)

// Response untuk login, dengan token
data class LoginResponse(
    val status: Boolean,
    val message: String,
    val data: UserData?,
    val token: String?  // token ada di response login
)

// Data User yang dikembalikan API
data class UserData(
    val id: Int,
    val username: String,
    val email: String,
    val saldo: String,      // saldo berupa string "0.00" sesuai contoh JSON
    val pekerjaan: String?
)

// Response wrapper untuk profile
data class ApiResponseUser(
    val status: Boolean,
    val data: UserData?
)

data class Item(
    val id: Int,
    val nama: String,
    val kategori: String,
    val harga: Int,
    val deskripsi: String,
    val gambar: String // kalau ada kolom gambar
)
data class WishlistRequest(
    val nama: String,
    val harga: Int,
    val gambar: String
)

data class DefaultResponse(
    val status: Boolean,
    val message: String
)

data class BeliRequest(
    val nama: String,
    val harga: Int
)

data class WishlistItem(
    val id: Int,
    val user_id: Int,
    val nama: String,
    val harga: Int,
    val gambar: String
)


// Interface API Retrofit
interface ApiService {
    @POST("register")
    fun registerUser(@Body request: RegisterRequest): Call<RegisterResponse>

    @POST("login")
    fun loginUser(@Body request: LoginRequest): Call<LoginResponse>

    @GET("items")
    fun getItems(): Call<List<Item>>

    @GET("profile")
    fun getProfile(): Call<ApiResponseUser>

    @POST("profile/update")
    fun updateProfile(@Body request: UpdateProfileRequest): Call<RegisterResponse>

    @POST("user/saldo")
    fun updateSaldo(@Body saldo: Map<String, String>): Call<RegisterResponse>
    // Ambil wishlist user (butuh token)
    @GET("wishlist")
    fun getWishlist(): Call<List<WishlistItem>>

    // Tambah wishlist (butuh token)
    @POST("wishlist")
    fun addToWishlist(@Body request: WishlistRequest): Call<DefaultResponse>

    // Beli item (butuh token)
    @POST("beli")
    fun beliItem(@Body request: BeliRequest): Call<DefaultResponse>
}