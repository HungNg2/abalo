export default {
    methods: {

        bfunktion: function() {
            this.count = this.afunktion(this.count);
        }
    },
    data: function() {
        return {
            count: 0
        };
    },
    template: `
        <div>
            <button @click="bfunktion">+</button>
            <p>{{ count }}</p>
        </div>
    `
};
