<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Groupings</h4>
                    <p class="card-description">
                        <a type="button" data-toggle="modal" data-target="#addGroupingModal" class="btn btn-outline-success btn-icon-text">
                            <i class="ti-plus btn-icon-prepend"></i>
                            New
                        </a>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered tablewithSearch">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Loan Officer</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(grouping, g) in groupings" :key="g">
                                    <td>
                                        <a :href="'/groupings/edit/'+grouping.id" class="ml-3 mr-3">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        {{ grouping.name}}
                                    </td>
                                    <td>{{ grouping.loan_officer.name }}</td>
                                    <td>{{ grouping.status }}</td>
                                    <!-- <td><button class="btn btn-danger" title="Delete Request" @click="deleteGrouping(grouping.id,g)">Delete</button></td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addGroupingModal" tabindex="-1" role="dialog" aria-labelledby="newLoanTypelabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newLoanTypelabel">New Grouping</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class='col-md-12 form-group'>
                            Name
                            <input type="text" name='name' class="form-control" required placeholder="Name" v-model="grouping.name">
                        </div>
                        <div class='col-md-12 form-group'>
                            Loan Officer
                            <multiselect
                                v-model="grouping.loan_officer"
                                :options="loan_officers"
                                :multiple="false"
                                track-by="id"
                                :custom-label="customLabel"
                                placeholder="Select Loan Officer"
                                @input="toggleSelected(grouping.loan_officer,'grouping','loan_officer_id')"
                             >
                            </multiselect>
                        </div>
                    </div>
                    <!-- Start: Error Message-->
                    <error-messages :errors="errors" v-if="errors.length > 0"/>
                    <!-- End: Error Message -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" @click="storeGrouping">Save</button>
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
    data(){
        return {
            groupings: [],
            grouping: {
                'name' : '',
                'loan_officer': '',
                'status': 'Active'
            },
            loan_officers: [],
            errors: []
        }
    },
    created() {
        this.commonRequest('/groupings/lists','groupings');
        this.commonRequest('/users/loan-officers','loan_officers');
    },
    methods:{
        customLabel (object) { return `${object.name}`},
        deleteGrouping(id,index){
            axios.delete(`/groupings/delete/${id}`)
            .then(response => { 
                this.groupings.splice(index, 1);
            })
            .catch(error => {
                this.errors = error.response.data.errors;
            })
        },
        storeGrouping(){
            this.errors = [];
            document.getElementById("loader").style.display = "block";
            axios.post('/groupings/store',this.grouping)
            .then(response => {
                window.location.href = '/groupings/main';
            })
            .catch(errors => {
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
        },
        toggleSelected(value,object,model) {
            this[object][model] = value.id;
        }
    }
}
</script>