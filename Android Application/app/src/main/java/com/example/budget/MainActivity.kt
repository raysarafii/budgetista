package com.example.budget

import android.content.Intent
import android.os.Bundle
import android.util.Log
import androidx.appcompat.app.AppCompatActivity
import androidx.recyclerview.widget.LinearLayoutManager
import com.example.budget.databinding.ActivityMainBinding
import retrofit2.Call
import retrofit2.Callback
import retrofit2.Response

class MainActivity : AppCompatActivity() {

    private lateinit var binding: ActivityMainBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)

        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        binding.rvPopuler.layoutManager = LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL, false)
        binding.rvUntukAnda.layoutManager = LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL, false)

        loadItems()

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
    }


    private fun getToken(): String {
        val sharedPref = getSharedPreferences("user_session", MODE_PRIVATE)
        return sharedPref.getString("token", "") ?: ""
    }

    private fun loadItems() {
        RetrofitClient.instance.getItems().enqueue(object : Callback<List<Item>> {
            override fun onResponse(call: Call<List<Item>>, response: Response<List<Item>>) {
                if (response.isSuccessful) {
                    val items = response.body() ?: emptyList()
                    val shuffled = items.shuffled()
                    val half = shuffled.size / 2

                    binding.rvPopuler.adapter = ItemAdapter(shuffled.take(half)) { item ->
                        openDetailItem(item)
                    }
                    binding.rvUntukAnda.adapter = ItemAdapter(shuffled.drop(half)) { item ->
                        openDetailItem(item)
                    }
                }
            }

            override fun onFailure(call: Call<List<Item>>, t: Throwable) {
                Log.e("MainActivity", "Error: ${t.message}")
            }
        })
    }

    private fun openDetailItem(item: Item) {
        val token = getToken()

        val intent = Intent(this, DetailItemActivity::class.java).apply {
            putExtra("nama", item.nama)
            putExtra("kategori", item.kategori)
            putExtra("harga", item.harga)
            putExtra("deskripsi", item.deskripsi)
            putExtra("gambar", item.gambar)
            putExtra("token", token)
        }
        startActivity(intent)
    }
}
