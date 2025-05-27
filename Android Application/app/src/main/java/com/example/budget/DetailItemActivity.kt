package com.example.budget

import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.bumptech.glide.Glide
import com.example.budget.databinding.ActivityDetailItemBinding
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class DetailItemActivity : AppCompatActivity() {
    private lateinit var binding: ActivityDetailItemBinding
    private lateinit var token: String
    private val baseUrl = "http://192.168.0.103:8000/"

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityDetailItemBinding.inflate(layoutInflater)
        setContentView(binding.root)

        token = intent.getStringExtra("token") ?: ""

        val nama = intent.getStringExtra("nama")
        val kategori = intent.getStringExtra("kategori")
        val harga = intent.getIntExtra("harga", 0)
        val deskripsi = intent.getStringExtra("deskripsi")
        val gambar = intent.getStringExtra("gambar") ?: ""

        binding.tvNama.text = nama
        binding.tvKategori.text = kategori
        binding.tvHarga.text = "Rp $harga"
        binding.tvDeskripsi.text = deskripsi

        // Load gambar dengan base URL + path relatif
        Glide.with(this).load(baseUrl + gambar).into(binding.ivGambar)

        binding.btnWishlist.setOnClickListener {
            if (token.isNotEmpty()) {
                addToWishlist(nama ?: "", harga, gambar)  // Kirim path relatif ke API
            } else {
                Toast.makeText(this, "Silakan login terlebih dahulu", Toast.LENGTH_SHORT).show()
            }
        }

        binding.btnBeli.setOnClickListener {
            if (token.isNotEmpty()) {
                beliItem(nama ?: "", harga)
            } else {
                Toast.makeText(this, "Silakan login terlebih dahulu", Toast.LENGTH_SHORT).show()
            }
        }
    }

    private fun addToWishlist(nama: String, harga: Int, gambar: String) {
        val request = WishlistRequest(nama, harga, gambar)
        val retrofitWithToken = RetrofitClient.getInstance(token)

        retrofitWithToken.addToWishlist(request)
            .enqueue(object : Callback<DefaultResponse> {
                override fun onResponse(call: Call<DefaultResponse>, response: Response<DefaultResponse>) {
                    if (response.isSuccessful && response.body()?.status == true) {
                        Toast.makeText(this@DetailItemActivity, response.body()?.message ?: "Berhasil ditambahkan ke wishlist", Toast.LENGTH_SHORT).show()
                        finish()  // Kembali ke MainActivity setelah sukses
                    } else {
                        Toast.makeText(this@DetailItemActivity, "Gagal menambahkan ke wishlist", Toast.LENGTH_SHORT).show()
                    }
                }

                override fun onFailure(call: Call<DefaultResponse>, t: Throwable) {
                    Toast.makeText(this@DetailItemActivity, "Gagal: ${t.message}", Toast.LENGTH_SHORT).show()
                }
            })
    }

    private fun beliItem(nama: String, harga: Int) {
        val request = BeliRequest(nama, harga)
        val retrofitWithToken = RetrofitClient.getInstance(token)

        retrofitWithToken.beliItem(request)
            .enqueue(object : Callback<DefaultResponse> {
                override fun onResponse(call: Call<DefaultResponse>, response: Response<DefaultResponse>) {
                    if (response.isSuccessful && response.body()?.status == true) {
                        Toast.makeText(this@DetailItemActivity, response.body()?.message ?: "Berhasil membeli item", Toast.LENGTH_SHORT).show()
                        finish()  // Kembali ke MainActivity setelah sukses
                    } else {
                        Toast.makeText(this@DetailItemActivity, "Gagal membeli item", Toast.LENGTH_SHORT).show()
                    }
                }

                override fun onFailure(call: Call<DefaultResponse>, t: Throwable) {
                    Toast.makeText(this@DetailItemActivity, "Gagal: ${t.message}", Toast.LENGTH_SHORT).show()
                }
            })
    }
}
