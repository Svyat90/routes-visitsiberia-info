<a href="" class="page-nav__share">
    {{ $vars['base_share'] }}
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="19.5px"
         height="22px"
         class="page-nav__icon-share">
        <path d="M0 0h24v24H0z" fill="none"/>
        <path
            d="M18 16.08c-.76 0-1.44.3-1.96.77L8.91 12.7c.05-.23.09-.46.09-.7s-.04-.47-.09-.7l7.05-4.11c.54.5 1.25.81 2.04.81 1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3c0 .24.04.47.09.7L8.04 9.81C7.5 9.31 6.79 9 6 9c-1.66 0-3 1.34-3 3s1.34 3 3 3c.79 0 1.5-.31 2.04-.81l7.12 4.16c-.05.21-.08.43-.08.65 0 1.61 1.31 2.92 2.92 2.92 1.61 0 2.92-1.31 2.92-2.92s-1.31-2.92-2.92-2.92z"/>
    </svg>
</a>

@section('scripts')
    @parent
    <script>
        const shareBtn = document.querySelector('.page-nav__share')
        const shareBtnMob = document.querySelector('.article__share')
        const modalWrap = document.querySelector('.modal-wr')
        const closeBtns = Array.from(document.querySelectorAll('.modal__esc'))
        const copyBtn = document.querySelector('.modal__copy')
        const copyInput = document.querySelector('.modal__input')

        shareBtn.addEventListener('click', (e) => {
            e.preventDefault()
            modalWrap.style.display = 'flex'
        })

        if (shareBtnMob) {
            shareBtnMob.addEventListener('click', e => {
                e.preventDefault()
                modalWrap.style.display = 'flex'
            })
        }

        closeBtns.forEach(closeBtn => {
            closeBtn.addEventListener('click', (e) => {
                if (e.target.isSameNode(closeBtn)) {
                    modalWrap.style.display = 'none'
                }
            })
        })

        copyInput.addEventListener('click', copyToClipboard)
        copyBtn.addEventListener('click', copyToClipboard)

        function copyToClipboard() {
            copyInput.disabled = false
            copyInput.select()
            copyInput.setSelectionRange(0, 99999)
            document.execCommand('copy')
            copyInput.disabled = true
        }
    </script>
@endsection
