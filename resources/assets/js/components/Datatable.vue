<template>
    <el-table
            :data="tableData"
            stripe
            style="width: 100%">
        <slot></slot>
    </el-table>
</template>

<script>
    export default {
        data() {
            return {
                tableData: []
            }
        },
        methods: {
            getData: function() {
                let self = this;

                window.axios.get(window.location.href)
                    .then(function(response) {
                        self.tableData = response.data;
                    });
            }
        },
        created: function() {
            this.getData();
        }
    }
</script>