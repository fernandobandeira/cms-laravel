<template>
    <div>    
        <el-option
                :key="item[config.key]"
                :label="label"
                :value="item[config.value]">
        </el-option>
        <template v-if="item.filhas != null">
            <nestedselect :key="child[config.key]" v-for="child in item.filhas" :item="child" :config="config"></nestedselect>
        </template>
    </div>
</template>

<script>
    export default {
        props: ['item', 'config'],
        data() {
            return {
                label: ''
            };
        },
        created() {
            var i;
            this.label = this.item[this.config.label];

            for (i = 0; i < this.item.depth; i++) {
                this.label = '- ' + this.label;
            }
        }
    }
</script>