<template>
    <div>    
        <el-option
                :disabled="onlyLeaves && item.filhas[0] != null"
                :key="item[config.key]"
                :label="label"
                :value="item[config.value]">
        </el-option>
        <template v-if="item.filhas[0] != null">
            <nestedselect :key="child[config.key]" :onlyLeaves="onlyLeaves" v-for="child in item.filhas" :item="child" :config="config"></nestedselect>
        </template>
    </div>
</template>

<script>
    export default {
        props: ['item', 'config', 'onlyLeaves'],
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