<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Company: {{ default_name }}</h4>
                    <div class="col-md-12">
                        <div class="row">
                            <div class='col-md-6 form-group'>
                                Name
                                <input type="text" name="name" class="form-control" v-model="company.name">
                            </div>
                            <div class='col-md-6 form-group'>
                                Logo
                                <input type="file" class="form-control" name="profile_avatar" accept=".png, .jpg, .jpeg" ref="logo" @change="uploadLogo($event)">
                            </div>
                        </div>
                        <div class="row">
                            <div class='col-md-6 form-group' v-if="id != 0">
                                Status
                                <select class="form-control" name="status" v-model="company.status">
                                    <option value="" disabled>Choose Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <!-- Start: Error Message-->
                        <error-messages :errors="errors" v-if="errors.length > 0"/>
                        <!-- End: Error Message -->
                        <a href='/companies/main' type="button" class="btn btn-secondary">Close</a>
                        <button type="submit" class="btn btn-primary" @click="updateCompany">Save</button>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</template>
<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>

<script>
import Multiselect from 'vue-multiselect'
export default {
    components: { Multiselect },
    props:['id'],
    data(){
        return {
            default_name: '',
            company: {
                'name' : '',
                'logo': '',
                'status': 'Active'
            },
            companies: [],
            errors: []
        }
    },
    created() {
        if(this.id)  this.commonRequest('/comapanies/lists','companies');
    },
    methods:{
        uploadLogo(e){
            this.company.logo = '';
            if(/\.(jpe?g|png|gif)$/i.test(e.target.files[0].name) === false){
                alert('Please use Image file');
                this.$refs.logo.value = null;
                return false;
            }

            let files = e.target.files || e.dataTransfer.files;
            if(!files.length) return
            thiscompany.logo = files[0];
        },
        updateCompany(){
            this.errors = [];
            document.getElementById("loader").style.display = "block";
            axios.post('/companies/store',this.grouping)
            .then(response => {
                window.location.href = '/companies/main';
            })
            .catch(errors => {
                document.getElementById("loader").style.display = "none";
                this.errors = Object.values(errors.response.data.errors);
            })
        },
        commonRequest(end_point,model){
            axios.get(end_point)
            .then(response => {
                this[model] = response.data;
            })
            .catch(errors => {
                this.errors = errors.response.data.errors;
            })
        }
    }
}
</script>