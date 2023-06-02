import Impressum from "./Impressum.js";
export default {
    emits: ['show-impressum'],
    components: {
        Impressum
    },
    data() {
        return {
            showImpressum: false,
        }
    },
    methods: {
        show() {
            this.showImpressum = true
            this.$emit("show-impressum", this.showImpressum)
        }
    },
    template:
        `<hr/>
        <div id="footer">
        <a href="#" @click="show">Impressum</a>
        </div>
        `
}

