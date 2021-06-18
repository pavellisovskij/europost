<template>
    <div class="row">
        <div class="col-sm">
            <select class="form-control" v-model="city">
                <option v-for="city in cities" v-bind:value="city">{{ city }}</option>
            </select>
        </div>
        <div class="col-sm">
            <ul class="list-group">
                <li class="list-group-item" v-for="office in list">
                    {{ office.WarehouseName }}
                    <br>
                    {{ office.Info1 }}
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        for (let office of this.offices) {
            this.cities.push(office.Address7Name);
        }
        this.cities = new Set(this.cities.sort());
        console.log('Component mounted.')
    },
    props: [
        'offices'
    ],
    data: function () {
        return {
            city: '',
            list: [],
            cities: []
        }
    },
    watch: {
        city: function (c) {
            this.list = this.offices.filter((office) => {
                return office.Address7Name == c;
            })
        }
    }
}
</script>
