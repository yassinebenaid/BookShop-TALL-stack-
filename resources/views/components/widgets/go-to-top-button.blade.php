<div x-data="getup" class="fixed bottom-20 right-20">
    <button x-show="showed" x-on:click="$dispatch('shouldScrollUp')" class="bg-slate-200 py-4 px-5 rounded-full text-xl"><i
            class="bi bi-chevron-up"></i></button>

</div>
<script>
    document.addEventListener("alpine:init", () => {
        Alpine.data('getup', () => ({
            showed: false,

            init() {
                window.onscroll = () => {
                    if (window.scrollY > 250) this.showed = true
                    else this.showed = false
                }
            }
        }))
    })
</script>
