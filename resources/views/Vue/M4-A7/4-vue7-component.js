export default {
    methods:{
        plus: function(){
          this.count++
        },
        minus: function (){
            this.count--
        }
    },
    data: function (){
        return {
            count:0
        }

    },
    template: ` <div>
            <button @click="plus">+</button>
            <button @click="minus">-</button>
            <p>{{ count }}</p>
                </div>`
}
