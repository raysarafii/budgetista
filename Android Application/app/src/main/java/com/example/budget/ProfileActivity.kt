package com.example.budget

import android.content.Intent
import android.content.SharedPreferences
import android.os.Bundle
import android.util.Log
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.example.budget.databinding.ActivityProfileBinding
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class ProfileActivity : AppCompatActivity() {

    private lateinit var binding: ActivityProfileBinding
    private lateinit var api: ApiService
    private lateinit var sharedPref: SharedPreferences

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        // Inisialisasi binding dan set content view
        binding = ActivityProfileBinding.inflate(layoutInflater)
        setContentView(binding.root)

        // Inisialisasi SharedPreferences dan Retrofit API dengan token
        sharedPref = getSharedPreferences("user_session", MODE_PRIVATE)
        val token = sharedPref.getString("token", "") ?: ""
        api = RetrofitClient.getInstance(token)

        // Load profile saat activity mulai
        getProfile()

        binding.navProfile.setOnClickListener {
            startActivity(Intent(this, ProfileActivity::class.java))
        }
        binding.navBudgeting.setOnClickListener {
            startActivity(Intent(this, SaldoActivity::class.java))
        }
        binding.navHome.setOnClickListener {
            startActivity(Intent(this, MainActivity::class.java))
        }
        binding.navWishlist.setOnClickListener {
            startActivity(Intent(this, WishlistActivity::class.java))
        }
        // Simpan perubahan saat tombol diklik
        binding.btnSimpan.setOnClickListener {
            updateProfile()
        }
    }

    private fun getProfile() {
        api.getProfile().enqueue(object : Callback<ApiResponseUser> {
            override fun onResponse(call: Call<ApiResponseUser>, response: Response<ApiResponseUser>) {
                if (response.isSuccessful) {
                    val apiResponse = response.body()
                    if (apiResponse != null && apiResponse.status && apiResponse.data != null) {
                        val user = apiResponse.data
                        Log.d("ProfileActivity", "User loaded: ${user.username}, ${user.email}, ${user.pekerjaan}")

                        // Tampilkan data ke UI via binding
                        binding.tvNamaKotak.text = user.username
                        binding.tvEmailKotak.text = user.email
                        binding.etNama.setText(user.username)
                        binding.etEmail.setText(user.email)
                        binding.etPekerjaan.setText(user.pekerjaan ?: "")
                    } else {
                        Toast.makeText(this@ProfileActivity, "Data tidak ditemukan", Toast.LENGTH_SHORT).show()
                    }
                } else {
                    Toast.makeText(this@ProfileActivity, "Gagal mengambil data", Toast.LENGTH_SHORT).show()
                }
            }

            override fun onFailure(call: Call<ApiResponseUser>, t: Throwable) {
                Toast.makeText(this@ProfileActivity, "Koneksi gagal: ${t.message}", Toast.LENGTH_SHORT).show()
                Log.e("ProfileActivity", "Error: ", t)
            }
        })
    }

    private fun updateProfile() {
        val nama = binding.etNama.text.toString().trim()
        val email = binding.etEmail.text.toString().trim()
        val pekerjaan = binding.etPekerjaan.text.toString().trim()

        if (nama.isBlank() || email.isBlank() || pekerjaan.isBlank()) {
            Toast.makeText(this, "Nama, email, dan pekerjaan wajib diisi", Toast.LENGTH_SHORT).show()
            return
        }

        val request = UpdateProfileRequest(
            username = nama,
            email = email,
            pekerjaan = pekerjaan
        )

        api.updateProfile(request).enqueue(object : Callback<RegisterResponse> {
            override fun onResponse(call: Call<RegisterResponse>, response: Response<RegisterResponse>) {
                if (response.isSuccessful && response.body()?.status == true) {
                    Toast.makeText(this@ProfileActivity, "Profil diperbarui", Toast.LENGTH_SHORT).show()
                    getProfile()
                } else {
                    Toast.makeText(this@ProfileActivity, "Gagal memperbarui", Toast.LENGTH_SHORT).show()
                }
            }

            override fun onFailure(call: Call<RegisterResponse>, t: Throwable) {
                Toast.makeText(this@ProfileActivity, "Koneksi gagal: ${t.message}", Toast.LENGTH_SHORT).show()
            }
        })
    }
}
