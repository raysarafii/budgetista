package com.example.budget

import android.Manifest
import android.content.Intent
import android.content.pm.PackageManager
import android.graphics.Bitmap
import android.os.Build
import android.os.Bundle
import android.os.Environment
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.core.app.ActivityCompat
import androidx.core.content.ContextCompat
import com.bumptech.glide.Glide
import com.bumptech.glide.request.target.CustomTarget
import com.bumptech.glide.request.transition.Transition
import com.example.budget.databinding.ActivityDetailItemBinding
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import java.io.File
import java.io.FileOutputStream
import java.io.IOException

class DetailItemActivity : AppCompatActivity() {
    private lateinit var binding: ActivityDetailItemBinding
    private lateinit var token: String
    private val baseUrl = "http://192.168.0.103:8000/"
    private var gambarPath: String = ""

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
        gambarPath = gambar

        binding.tvNama.text = nama
        binding.tvKategori.text = kategori
        binding.tvHarga.text = "Rp $harga"
        binding.tvDeskripsi.text = deskripsi

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

        // Tampilkan gambar
        Glide.with(this).load(baseUrl + gambar).into(binding.ivGambar)

        binding.btnWishlist.setOnClickListener {
            if (token.isNotEmpty()) {
                addToWishlist(nama ?: "", harga, gambar)
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

        binding.btnDownload.setOnClickListener {
            if (Build.VERSION.SDK_INT < Build.VERSION_CODES.Q) {
                if (ContextCompat.checkSelfPermission(this, Manifest.permission.WRITE_EXTERNAL_STORAGE) != PackageManager.PERMISSION_GRANTED) {
                    ActivityCompat.requestPermissions(this, arrayOf(Manifest.permission.WRITE_EXTERNAL_STORAGE), 1001)
                } else {
                    downloadImage(gambarPath)
                }
            } else {
                downloadImage(gambarPath)
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
                        finish()
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
                        finish()
                    } else {
                        Toast.makeText(this@DetailItemActivity, "Gagal membeli item", Toast.LENGTH_SHORT).show()
                    }
                }

                override fun onFailure(call: Call<DefaultResponse>, t: Throwable) {
                    Toast.makeText(this@DetailItemActivity, "Gagal: ${t.message}", Toast.LENGTH_SHORT).show()
                }
            })
    }

    private fun downloadImage(gambar: String) {
        val url = baseUrl + gambar
        Glide.with(this)
            .asBitmap()
            .load(url)
            .into(object : CustomTarget<Bitmap>() {
                override fun onResourceReady(resource: Bitmap, transition: Transition<in Bitmap>?) {
                    saveImage(resource, gambar.substringAfterLast("/"))
                }

                override fun onLoadCleared(placeholder: android.graphics.drawable.Drawable?) {}
            })
    }

    private fun saveImage(bitmap: Bitmap, fileName: String) {
        val directory = if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.Q) {
            getExternalFilesDir(Environment.DIRECTORY_PICTURES)
        } else {
            Environment.getExternalStoragePublicDirectory(Environment.DIRECTORY_DOWNLOADS)
        }

        val file = File(directory, fileName)
        try {
            val outputStream = FileOutputStream(file)
            bitmap.compress(Bitmap.CompressFormat.PNG, 100, outputStream)
            outputStream.flush()
            outputStream.close()
            Toast.makeText(this, "Gambar disimpan di ${file.absolutePath}", Toast.LENGTH_LONG).show()
        } catch (e: IOException) {
            e.printStackTrace()
            Toast.makeText(this, "Gagal menyimpan gambar", Toast.LENGTH_SHORT).show()
        }
    }

    override fun onRequestPermissionsResult(requestCode: Int, permissions: Array<out String>, grantResults: IntArray) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults)
        if (requestCode == 1001 && grantResults.isNotEmpty() && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
            downloadImage(gambarPath)
        } else {
            Toast.makeText(this, "Izin ditolak", Toast.LENGTH_SHORT).show()
        }
    }
}
