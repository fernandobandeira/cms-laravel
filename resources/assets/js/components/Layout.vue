<template>
    <div>
        <el-menu theme="dark" :default-active="''" mode="horizontal">
            <el-menu-item index="1">
                <a href="/">
                    <div class="logo">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="72px" height="32px" viewBox="0 18 109.5 51" enable-background="new 0 18 109.5 51" xml:space="preserve">
                            <g>
                                <path d="M83.186,49.028c0.228-1.252,0.268-2.543,0.268-3.859c0-12.384-9.07-21.548-20.973-21.548
                                    c-11.899,0-21.548,9.647-21.548,21.548c0,11.9,9.647,21.549,21.548,21.549c6.878,0,11.981-2.197,16.245-6.207l0.855-0.959
                                    c0,0-7.166-6.041-7.198-6.059c-2.226,2.666-6.155,3.818-9.902,3.818c-5.355,0-9.898-3.471-11.511-8.283H83.186L83.186,49.028z
                                     M62.482,33.026c5.368,0,9.519,3.085,11.123,7.914H50.96C52.563,36.111,57.114,33.026,62.482,33.026z"/>
                                <path d="M45.561,41.226h-9.711h-4.519h-3.799l-6.464,7.701h14.791c-1.607,4.84-6.167,8.332-11.546,8.332
                                    c-6.719,0-12.166-5.447-12.166-12.166c0-6.72,5.446-12.167,12.166-12.167c3.88,0,7.334,1.818,9.561,4.646l6.133-7.308
                                    C36.071,26.1,30.496,23.5,24.313,23.5c-11.925,0-21.592,9.668-21.592,21.593c0,11.924,9.667,21.592,21.592,21.592
                                    c11.926,0,21.592-9.668,21.592-21.592C45.906,43.772,45.788,42.479,45.561,41.226z"/>
                                <path stroke="#000000" stroke-width="0.0307" stroke-miterlimit="10" d="M100.786,56.946"/>
                                <path d="M98.961,57.274c-0.022,0-0.042-0.002-0.063-0.002c-0.007,0-0.015,0.002-0.021,0.002c0,0,0-0.002,0-0.004
                                    c-1.749-0.045-3.138-1.473-3.138-3.232c0-0.119,0.006-15.146,0.006-15.146l6.485-0.031l5.835-7.471h-12.32V20.068l-9.431-0.401
                                    h-0.013v35.852c0,1.66,0.363,3.236,1.014,4.652c0.02,0.045,0.04,0.09,0.062,0.133c0.029,0.064,0.061,0.127,0.091,0.189
                                    c1.755,3.58,5.366,6.146,9.848,6.213l0.507-0.002c1.814-0.023,3.451-0.232,4.932-0.58c1.962-0.615,3.716-1.695,5.135-3.113
                                    l-6.395-6.418C100.718,57.071,99.849,57.274,98.961,57.274z"/>
                            </g>
                        </svg>
                    </div>
                </a>
            </el-menu-item>
            <el-submenu index="2" class="fr">
                <template slot="title">Workspace</template>
                <el-menu-item index="2-1">item one</el-menu-item>
                <el-menu-item index="2-2">item two</el-menu-item>
                <el-menu-item index="2-3">item three</el-menu-item>
            </el-submenu>
            <el-menu-item index="3" class="fr"><a href="https://www.ele.me" target="_blank">Orders</a></el-menu-item>
        </el-menu>
        <el-row>
            <el-col :span="3">
                <div class="sidebar">
                    <sidenav></sidenav>
                </div>
            </el-col>
            <el-col :span="21">
                <div class="container">
                    <slot></slot>
                </div>
            </el-col>
        </el-row>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                drawer: null,
                right: null
            }
        }
    }
</script>