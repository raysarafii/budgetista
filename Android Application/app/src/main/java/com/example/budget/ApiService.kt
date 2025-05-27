package com.example.budget

import okhttp3.MultipartBody
import okhttp3.RequestBody
import retrofit2.Call
import retrofit2.http.*

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
    val saldo: String,      // saldo berupa string "0.00"
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
    val gambar: String
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
data class BeliHapusRequest(val wishlist_id: Int)

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

    @GET("wishlists")
    fun getWishlist(): Call<List<WishlistItem>>

    @POST("wishlists")
    fun addToWishlist(@Body request: WishlistRequest): Call<DefaultResponse>

    @POST("wishlists/beli-hapus")
    fun beliDanHapus(@Body request: BeliHapusRequest): Call<DefaultResponse>

    @POST("wishlists/beli")
    fun beliItem(@Body request: BeliRequest): Call<DefaultResponse>

    @Multipart
    @POST("wishlists/upload")
    fun uploadWishlist(
        @Part("nama") nama: RequestBody,
        @Part("harga") harga: RequestBody,
        @Part gambar: MultipartBody.Part
    ): Call<DefaultResponse>

}
