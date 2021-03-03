<template>
<div id='app' style='box-shadow: 0 5px 5px 2px black; height: 270px'>
    <div class='sugestion'>
        <p>Oglądałeś? Oceń:</p>
    </div>
    <div @mouseleave="showCurrentRating(0)" class="rating">
        <star-rating 
            :show-rating="false" 
            @current-rating="showCurrentRating"
            @rating-selected="setCurrentSelectedRating"
           
            :increments="1" 
            :max-rating="10" 
            :star-size="30">
            
        </star-rating>
       
    </div>

        <div v-if="Number.isInteger(currentRating) && !Number.isInteger(currentSelectedRating)" class="content">   
           <div class="rows"> 
                <div class="number">
                    <p>{{ currentRating }}</p>
                </div>
                <div class="show">
                   <p> {{ items[currentRating-1] }} </p> 
                </div>
            </div>
        </div>
        <div v-if="Number.isInteger(currentSelectedRating)" class='content'>
            <div class="rows"> 
                <div class="number">
                    <p>{{ currentSelectedRating }}</p>
                </div>
                <div class="show">
                       <button @click.prevent='selectRating' class="btn btn-outline-dark btn-sm btn-block" style='width:150px;'>
                           Oceń
                       </button>
                </div>
            </div>
             </div>

    
    
</div>
</template>

<script>
export default {
    props:['movie'],
    
    data() {
        return {
            rating: 0,
            currentRating: "No Rating",
            currentSelectedRating: "No Current Rating",
            items: ['Nieporozumienie', 'Bardzo zły', 'Słaby', 'Ujdzie', 'Średni',
                     'Niezły', 'Dobry', 'Bardzo dobry', 'Wspaniały', 'Arcydzieło']
        }
    },
    methods: {
        reloadPage(){
            window.location.reload()
        },

        showCurrentRating: function(rating) {
            this.currentRating = (rating === 0) ? this.currentSelectedRating : rating
 
        },
        
        setCurrentSelectedRating: function(rating) {
            this.currentSelectedRating = rating;
        },
        
        selectRating(){
            axios.post(`/rating/${this.movie}`, {rating: this.currentSelectedRating})
            .then( res => {
                console.log('currentrating', this.currentSelectedRating)
                this.reloadPage()
            })

            this.currentSelectedRating = 'No current Rating'
            
        },
        
    }
}
</script>

<style>

</style>