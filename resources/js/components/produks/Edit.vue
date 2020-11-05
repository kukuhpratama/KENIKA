<template>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">EDIT PRODUK</div>

                    <div class="card-body">

                         <form @submit.prevent="ProdukUpdate">
                           
                            <div class="form-group">
                                <label>NAMA PRODUK</label>
                                <input type="text" class="form-control" v-model="produk.nama_produk"
                                       placeholder="Masukkan Nama Produk">
                                <div v-if="validation.nama_produk">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.nama_produk[0] }}
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                                <label>HARGA PRODUK</label>
                                <input type="text" class="form-control" v-model="produk.harga_produk"
                                       placeholder="Masukkan Harga Produk">
                                <div v-if="validation.harga_produk">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.harga_produk[0] }}
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                <label>KATEGORI PRODUK</label>
                                <input type="text" class="form-control" v-model="produk.kategori_produk"
                                       placeholder="Masukkan Ketegori Produk">
                                <div v-if="validation.kategori_produk">
                                <div class="alert alert-da-nger mt-1" role="alert">
                                        {{ validation.kategori_produk[0] }}
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                <label>KETERANGAN PRODUK</label>
                                <input type="text" class="form-control" v-model="produk.keterangan_produk"
                                       placeholder="Masukkan Keterangan Produk">
                                <div v-if="validation.keterangan_produk">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.keterangan_produk[0] }}
                                    </div>
                                </div>
                            </div>
                                     <div class="form-group">
                                <label>STATUS PRODUK</label>
                                <input type="text" class="form-control" v-model="produk.status_produk"
                                       placeholder="Masukkan StatusProduk">
                                <div v-if="validation.status_produk">
                                    <div class="alert alert-danger mt-1" role="alert">
                                        {{ validation.status_produk[0] }}
                                    </div>
                                </div>
                            </div>
                  

                            
                            <div class="form-group">
                                <button type="submit" class="btn btn-md btn-success">SIMPAN</button>
                                <button type="reset" class="btn btn-md btn-danger">RESET</button>
                            </div>

                         </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        data() {
            return {
                produk: {},
                validation: []
            }
        },
        created() {
            let uri = `http://localhost:8000/api/produks/${this.$route.params.id}`;
            this.axios.get(uri).then((response) => {
                this.produk = response.data.data;
            });
        },
        methods: {
            ProdukUpdate() {
                let uri = `http://localhost:8000/api/produks/update/${this.$route.params.id}`;
                this.axios.post(uri, this.produk)
                    .then((response) => {
                        this.$router.push({name: 'produks'});
                    }).catch(error => {
                    this.validation = error.response.data.data;
                });
            }
        }
    }
</script>