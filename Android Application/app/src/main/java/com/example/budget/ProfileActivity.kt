package com.example.budget

import android.content.Intent
import android.content.SharedPreferences
import android.os.Bundle
import android.util.Log
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import com.example.budget.databinding.ActivityMainBinding
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class ProfileActivity : AppCompatActivity() {

    private lateinit var etNama: EditText
    private lateinit var etEmail: EditText
    private lateinit var etPekerjaan: EditText
    private lateinit var tvNamaKotak: TextView
    private lateinit var tvEmailKotak: TextView
    private lateinit var btnSimpan: Button
    private lateinit var api: ApiService
    private lateinit var sharedPref: SharedPreferences
    private lateinit var binding: ActivityMainBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_profile)
        // Inisialisasi View
        etNama = findViewById(R.id.etNama)
        etEmail = findViewById(R.id.etEmail)
        etPekerjaan = findViewById(R.id.etPekerjaan)
        tvNamaKotak = findViewById(R.id.tvNamaKotak)
        tvEmailKotak = findViewById(R.id.tvEmailKotak)
        btnSimpan = findViewById(R.id.btnSimpan)

        // Ambil token dari SharedPreferences
        sharedPref = getSharedPreferences("user_session", MODE_PRIVATE)
        val token = sharedPref.getString("token", "") ?: ""
        api = RetrofitClient.getInstance(token)

        // Load profile saat activity mulai
        getProfile()

        // Simpan perubahan
        btnSimpan.setOnClickListener {
            updateProfile()
        }
        binding.navProfile.setOnClickListener {
            val intent = Intent(this, ProfileActivity::class.java)
            startActivity(intent)
        }

        binding.navBudgeting.setOnClickListener {
            val intent = Intent(this, SaldoActivity::class.java)
            startActivity(intent)
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

                        // Tampilkan ke UI
                        tvNamaKotak.text = user.username
                        tvEmailKotak.text = user.email
                        etNama.setText(user.username)
                        etEmail.setText(user.email)
                        etPekerjaan.setText(user.pekerjaan ?: "")
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
        val nama = etNama.text.toString().trim()
        val email = etEmail.text.toString().trim()
        val pekerjaan = etPekerjaan.text.toString().trim()

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
