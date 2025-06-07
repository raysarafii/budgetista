package com.example.budget

import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Button
import android.widget.ImageView
import android.widget.TextView
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide

class WishlistAdapter(
    private val list: List<WishlistItem>,
    private val onBuyClick: (WishlistItem) -> Unit
) : RecyclerView.Adapter<WishlistAdapter.ViewHolder>() {

    inner class ViewHolder(view: View) : RecyclerView.ViewHolder(view) {
        val nama: TextView = view.findViewById(R.id.tvNama)
        val harga: TextView = view.findViewById(R.id.tvHarga)
        val gambar: ImageView = view.findViewById(R.id.ivGambar)
        val btnBuy: Button = view.findViewById(R.id.btnBuy)
    }

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ViewHolder {
        val view = LayoutInflater.from(parent.context)
            .inflate(R.layout.item_wishlist, parent, false)
        return ViewHolder(view)
    }

    override fun onBindViewHolder(holder: ViewHolder, position: Int) {
        val item = list[position]
        holder.nama.text = item.nama
        holder.harga.text = "Rp ${item.harga}"

        val fullUrl = "http://192.168.0.103:8000/${item.gambar}"
        Glide.with(holder.itemView.context)
            .load(fullUrl)
            .into(holder.gambar)

        holder.btnBuy.setOnClickListener {
            onBuyClick(item)
        }
    }

    override fun getItemCount(): Int = list.size
}
