package com.example.budget

import android.app.Activity
import android.content.Intent
import android.net.Uri
import android.os.Bundle
import android.provider.MediaStore
import android.widget.*
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import androidx.recyclerview.widget.RecyclerView
import com.example.budget.databinding.ActivityWishlistBinding
import okhttp3.MediaType.Companion.toMediaTypeOrNull
import okhttp3.MultipartBody
import okhttp3.RequestBody
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response
import java.io.File

class WishlistActivity : AppCompatActivity() {

    private lateinit var api: ApiService
    private lateinit var token: String
    private var saldoUser = 0

    private val PICK_IMAGE_REQUEST = 100
    private var selectedImageUri: Uri? = null

    private lateinit var etNama: EditText
    private lateinit var etHarga: EditText
    private lateinit var btnChooseImage: Button
    private lateinit var btnUpload: Button
    private lateinit var ivPreview: ImageView
    private lateinit var binding: ActivityWishlistBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityWishlistBinding.inflate(layoutInflater)
        setContentView(binding.root)

        // Ambil token dari shared preferences
        val sharedPref = getSharedPreferences("user_session", MODE_PRIVATE)
        token = sharedPref.getString("token", "") ?: ""
        api = RetrofitClient.getInstance(token)

        etNama = findViewById(R.id.etNama)
        etHarga = findViewById(R.id.etHarga)
        btnChooseImage = findViewById(R.id.btnPilihGambar)
        btnUpload = findViewById(R.id.btnUpload)
        ivPreview = findViewById(R.id.ivPreview)

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

        btnChooseImage.setOnClickListener {
            val intent = Intent(Intent.ACTION_GET_CONTENT)
            intent.type = "image/*"
            intent.addCategory(Intent.CATEGORY_OPENABLE)
            startActivityForResult(Intent.createChooser(intent, "Pilih gambar"), PICK_IMAGE_REQUEST)
        }

        btnUpload.setOnClickListener {
            val nama = etNama.text.toString()
            val hargaStr = etHarga.text.toString()
            val harga = hargaStr.toIntOrNull() ?: 0

            if (nama.isEmpty() || harga == 0 || selectedImageUri == null) {
                Toast.makeText(this, "Isi semua field dan pilih gambar!", Toast.LENGTH_SHORT).show()
                return@setOnClickListener
            }

            val filePath = getRealPathFromURI(selectedImageUri!!)
            if (filePath == null) {
                Toast.makeText(this, "Gagal mendapatkan file path gambar", Toast.LENGTH_SHORT).show()
                return@setOnClickListener
            }

            val file = File(filePath)
            val requestFile = RequestBody.create("image/*".toMediaTypeOrNull(), file)
            val body = MultipartBody.Part.createFormData("gambar", file.name, requestFile)

            val namaPart = RequestBody.create("text/plain".toMediaTypeOrNull(), nama)
            val hargaPart = RequestBody.create("text/plain".toMediaTypeOrNull(), hargaStr)

            api.uploadWishlist(namaPart, hargaPart, body).enqueue(object : Callback<DefaultResponse> {
                override fun onResponse(call: Call<DefaultResponse>, response: Response<DefaultResponse>) {
                    if (response.isSuccessful && response.body()?.status == true) {
                        Toast.makeText(this@WishlistActivity, "Wishlist berhasil ditambahkan", Toast.LENGTH_SHORT).show()
                        etNama.text.clear()
                        etHarga.text.clear()
                        selectedImageUri = null
                        ivPreview.setImageResource(0)
                        loadData()
                    } else {
                        Toast.makeText(this@WishlistActivity, "Gagal menambahkan wishlist", Toast.LENGTH_SHORT).show()
                    }
                }

                override fun onFailure(call: Call<DefaultResponse>, t: Throwable) {
                    Toast.makeText(this@WishlistActivity, "Error: ${t.message}", Toast.LENGTH_SHORT).show()
                }
            })
        }

        loadData()
    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {
        super.onActivityResult(requestCode, resultCode, data)
        if (requestCode == PICK_IMAGE_REQUEST && resultCode == Activity.RESULT_OK) {
            selectedImageUri = data?.data
            ivPreview.setImageURI(selectedImageUri)
        }
    }

    private fun getRealPathFromURI(contentUri: Uri): String? {
        val proj = arrayOf(MediaStore.Images.Media.DATA)
        contentResolver.query(contentUri, proj, null, null, null)?.use { cursor ->
            if (cursor.moveToFirst()) {
                val columnIndex = cursor.getColumnIndexOrThrow(MediaStore.Images.Media.DATA)
                return cursor.getString(columnIndex)
            }
        }
        return null
    }

    private fun loadData() {
        api.getProfile().enqueue(object : Callback<ApiResponseUser> {
            override fun onResponse(call: Call<ApiResponseUser>, response: Response<ApiResponseUser>) {
                saldoUser = response.body()?.data?.saldo?.toDoubleOrNull()?.toInt() ?: 0

                api.getWishlist().enqueue(object : Callback<List<WishlistItem>> {
                    override fun onResponse(call: Call<List<WishlistItem>>, response: Response<List<WishlistItem>>) {
                        val allItems = response.body() ?: listOf()
                        val bisaDibeli = allItems.filter { it.harga <= saldoUser }
                        val tidakBisa = allItems.filter { it.harga > saldoUser }

                        findViewById<RecyclerView>(R.id.rvBisaDibeli).apply {
                            layoutManager = LinearLayoutManager(this@WishlistActivity, LinearLayoutManager.HORIZONTAL, false)
                            adapter = WishlistAdapter(bisaDibeli) { item ->
                                beliItem(item)
                            }
                        }

                        findViewById<RecyclerView>(R.id.rvTidakBisa).apply {
                            layoutManager = LinearLayoutManager(this@WishlistActivity, LinearLayoutManager.HORIZONTAL, false)
                            adapter = WishlistAdapter(tidakBisa) {

                            }
                        }
                    }

                    override fun onFailure(call: Call<List<WishlistItem>>, t: Throwable) {
                        Toast.makeText(this@WishlistActivity, "Gagal ambil wishlist", Toast.LENGTH_SHORT).show()
                    }
                })
            }

            override fun onFailure(call: Call<ApiResponseUser>, t: Throwable) {
                Toast.makeText(this@WishlistActivity, "Gagal ambil profile", Toast.LENGTH_SHORT).show()
            }
        })
    }

    private fun beliItem(item: WishlistItem) {
        val request = BeliHapusRequest(wishlist_id = item.id)
        api.beliDanHapus(request).enqueue(object : Callback<DefaultResponse> {
            override fun onResponse(call: Call<DefaultResponse>, response: Response<DefaultResponse>) {
                if (response.isSuccessful && response.body()?.status == true) {
                    Toast.makeText(this@WishlistActivity, "Berhasil membeli ${item.nama}", Toast.LENGTH_SHORT).show()
                    loadData()
                } else {
                    Toast.makeText(this@WishlistActivity, "Gagal membeli item", Toast.LENGTH_SHORT).show()
                }
            }

            override fun onFailure(call: Call<DefaultResponse>, t: Throwable) {
                Toast.makeText(this@WishlistActivity, "Error: ${t.message}", Toast.LENGTH_SHORT).show()
            }
        })
    }

}
