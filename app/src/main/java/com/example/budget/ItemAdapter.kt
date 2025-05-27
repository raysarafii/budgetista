package com.example.budget

import android.view.LayoutInflater
import android.view.ViewGroup
import androidx.recyclerview.widget.RecyclerView
import com.bumptech.glide.Glide
import com.example.budget.databinding.ItemViewBinding

class ItemAdapter(
    private val itemList: List<Item>,
    private val onItemClick: (Item) -> Unit
) : RecyclerView.Adapter<ItemAdapter.ItemViewHolder>() {

    class ItemViewHolder(val binding: ItemViewBinding) : RecyclerView.ViewHolder(binding.root)

    override fun onCreateViewHolder(parent: ViewGroup, viewType: Int): ItemViewHolder {
        val binding = ItemViewBinding.inflate(LayoutInflater.from(parent.context), parent, false)
        return ItemViewHolder(binding)
    }

    override fun getItemCount(): Int = itemList.size

    override fun onBindViewHolder(holder: ItemViewHolder, position: Int) {
        val item = itemList[position]
        holder.binding.namaItem.text = item.nama
        holder.binding.hargaItem.text = "Rp. ${item.harga}"

        Glide.with(holder.itemView.context)
            .load("http://192.168.0.103:8000/${item.gambar}")
            .into(holder.binding.gambarItem)

        holder.binding.root.setOnClickListener {
            onItemClick(item)
        }
    }
}
