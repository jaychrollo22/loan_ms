<template>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Group: {{ default_name }}</h4>
                    <div class="col-md-12">
                            <div class="row">
                            <div class='col-md-6 form-group'>
                                Name
                                <input type="text" name="name" class="form-control" v-model="grouping.name">
                            </div>
                            <div class='col-md-6 form-group'>
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
                            <div class='col-md-6 form-group'>
                                Status
                                <select class="form-control" name="status" v-model="grouping.status">
                                    <option value="" disabled>Choose Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <a href='/groupings/main' type="button" class="btn btn-secondary">Close</a>
                        <button type="submit" class="btn btn-primary" @click="updateGrouping">Save</button>
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
        this.fetchGrouping();
        this.commonRequest('/users/loan-officers','loan_officers');
    },
    methods:{
        customLabel (object) { return `${object.name}`},
        async fetchGrouping(){
            const response = await axios.get('/groupings/show/'+this.id);
            this.grouping = response.data;
            this.default_name = this.grouping.name;
        },
        updateGrouping(){
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