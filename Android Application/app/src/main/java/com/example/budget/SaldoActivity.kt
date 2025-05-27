package com.example.budget

import android.content.Intent
import android.content.SharedPreferences
import android.os.Bundle
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import com.example.budget.databinding.ActivityMainBinding
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class SaldoActivity : AppCompatActivity() {

    private lateinit var tvSaldo: TextView
    private lateinit var etTambahSaldo: EditText
    private lateinit var btnTambahSaldo: Button
    private lateinit var api: ApiService
    private lateinit var sharedPref: SharedPreferences
    private lateinit var binding: ActivityMainBinding
    private var currentSaldo: Double = 0.0

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_saldo)

        tvSaldo = findViewById(R.id.tvSaldo)
        etTambahSaldo = findViewById(R.id.etTambahSaldo)
        btnTambahSaldo = findViewById(R.id.btnTambahSaldo)

        sharedPref = getSharedPreferences("user_session", MODE_PRIVATE)
        val token = sharedPref.getString("token", "") ?: ""
        api = RetrofitClient.getInstance(token)

        loadSaldo()

        btnTambahSaldo.setOnClickListener {
            val tambahan = etTambahSaldo.text.toString().toDoubleOrNull()
            if (tambahan != null && tambahan > 0) {
                updateSaldo(currentSaldo + tambahan)
            } else {
                Toast.makeText(this, "Masukkan jumlah yang valid", Toast.LENGTH_SHORT).show()
            }
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

    private fun loadSaldo() {
        api.getProfile().enqueue(object : Callback<ApiResponseUser> {
            override fun onResponse(call: Call<ApiResponseUser>, response: Response<ApiResponseUser>) {
                if (response.isSuccessful) {
                    val user = response.body()?.data
                    currentSaldo = user?.saldo?.toDoubleOrNull() ?: 0.0
                    tvSaldo.text = "Rp. %.2f".format(currentSaldo)
                } else {
                    Toast.makeText(this@SaldoActivity, "Gagal mengambil saldo", Toast.LENGTH_SHORT).show()
                }
            }

            override fun onFailure(call: Call<ApiResponseUser>, t: Throwable) {
                Toast.makeText(this@SaldoActivity, "Koneksi gagal: ${t.message}", Toast.LENGTH_SHORT).show()
            }
        })
    }

    private fun updateSaldo(newSaldo: Double) {
        val updateRequest = mapOf("saldo" to "%.2f".format(newSaldo))

        api.updateSaldo(updateRequest).enqueue(object : Callback<RegisterResponse> {
            override fun onResponse(call: Call<RegisterResponse>, response: Response<RegisterResponse>) {
                if (response.isSuccessful && response.body()?.status == true) {
                    Toast.makeText(this@SaldoActivity, "Saldo diperbarui", Toast.LENGTH_SHORT).show()
                    loadSaldo()
                    etTambahSaldo.text.clear()
                } else {
                    Toast.makeText(this@SaldoActivity, "Gagal memperbarui saldo", Toast.LENGTH_SHORT).show()
                }
            }

            override fun onFailure(call: Call<RegisterResponse>, t: Throwable) {
                Toast.makeText(this@SaldoActivity, "Koneksi gagal: ${t.message}", Toast.LENGTH_SHORT).show()
            }
        })
    }
}
