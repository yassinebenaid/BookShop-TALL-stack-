<div x-data="slider" class="relative w-full h-96">

    <div class="absolute text-neutral-400 h-full -left-10 flex justify-between w-[106%] text-3xl">
        <button x-on:click="decrease"><i class="bi bi-chevron-left"></i></button>
        <button x-on:click="increase"><i class="bi bi-chevron-right"></i></button>
    </div>


    <div class="flex w-full overflow-hidden">
        <template x-for="(img,index) in total" :key="index">
            <img x-transition:enter="transition w-0 ease-in duration-500"
                x-transition:leave="transition duration-500 ease-out" x-show="selected === index" :src="images[index]"
                class="w-full h-96 rounded-[0_0_1rem_1rem] ">
        </template>
    </div>


    <div class="absolute flex justify-center w-full gap-4 py-3 text-xs text-neutral-300 top-full">

        <template x-for="(item,index) in total" :key="item">
            <button x-on:click="selected = index"><i
                    :class="{ 'text-[8px]': selected !== index, 'text-black ': selected === index }"
                    class="duration-300 bi bi-circle-fill"></i></button>
        </template>

    </div>
</div>



<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data("slider", () => ({
            selected: 0,

            init() {
                setInterval(() => {
                    this.increase
                }, 6000);
            },

            get total() {
                return this.images.length
            },

            get increase() {
                this.selected < this.total - 1 ? this.selected++ : this.selected = 0
            },

            get decrease() {
                this.selected > 0 ? this.selected-- : this.selected = this.total - 1
            },



            images: [
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQp2IhTPdR5-OfDamge4Xda1EujFSWBNOfcAQd_wnXQrZu5lVYM2Gf1vHNEgapiOJQDWfE&usqp=CAU",
                "https://www.hollywoodreporter.com/wp-content/uploads/2022/04/2022_04_06-books.jpg?w=1024",
                "https://www.wfla.com/wp-content/uploads/sites/71/2022/01/BOOK-STILL0.jpg?strip=1",

            ],

        }))
    })
</script>
