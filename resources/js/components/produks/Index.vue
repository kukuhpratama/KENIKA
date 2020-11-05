<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">LIST PRODUKS</div>

                    <div class="card-body">
                        <router-link :to="{ name: 'create' }" class="btn btn-md btn-success">TAMBAH PRODUK</router-link>

                        <div class="table-responsive mt-2">
                            <table class="table table-hover table-bordered">
                                <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga Produk</th>
                                    <th>Kategori Produk</th>
                                    <th>Keterangan Produk</th>
                                    <th>Status Produk</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="(produk, index) in produks" :key="produk.id">
                                    <td>{{ produk.nama_produk }}</td>
                                    <td>{{ produk.harga_produk }}</td>
                                    <td>{{ produk.kategori_produk }}</td>
                                    <td>{{ produk.keterangan_produk }}</td>
                                    <td>{{ produk.status_produk }}</td>
                                    <td class="text-center">
                                        <router-link :to="{name: 'edit', params: { id: produk.id }}" class="btn btn-sm btn-primary">EDIT</router-link>
                                        <button @click.prevent="ProdukDelete(produk.id, index)" class="btn btn-sm btn-danger">HAPUS</button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import axios from 'axios';
    export default {
        data() {
            return {
                produks: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/produks`;
            this.axios.get(uri).then(response => {
                this.produks = response.data.data;
            });
        },
        methods: {
            ProdukDelete(id, index)
            {
                this.axios.delete(`http://localhost:8000/api/produks/${id}`)
                    .then(response => {
                        this.produks.splice(index, 1);
                    }).catch(error => {
                    alert('system error!');
                });
            }
        }
    }
</script>