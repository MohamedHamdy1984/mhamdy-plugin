//global variables
const sliderView = document.querySelector('.mhamdy-slider--view > ul');
const sliderViewSlides = document.querySelectorAll('.mhamdy-slider--view__slides');
const arrowLeft = document.querySelector('.mhamdy-slider--arrows__left');
const arrowRight = document.querySelector('.mhamdy-slider--arrows__right');
const sliderLength = sliderViewSlides.length;

// sliding fun.
const slideMe = (sliderViewItems, isActiveItem) => {
    isActiveItem.classList.remove('is-active');
    sliderViewItems.classList.add('is-active');

    sliderView.setAttribute('style', `transform:translateX(-${sliderViewItems.offsetLeft}px)`);
}



// before sliding fun.
const beforeSliding = i => {
    let isActiveItem = document.querySelector('.mhamdy-slider--view__slides.is-active');
    let currentItem = Array.from(sliderViewSlides).indexOf(isActiveItem) + i;
    let nextItem = currentItem + i;
    let sliderViewItems = document.querySelector(`.mhamdy-slider--view__slides:nth-child(${nextItem})`);

    if(nextItem > sliderLength){
        sliderViewItems = document.querySelector('.mhamdy-slider--view__slides:nth-child(1)');
    }

    if(nextItem == 0){
        sliderViewItems = document.querySelector(`.mhamdy-slider--view__slides:nth-child(${sliderLength})`);
    }

    slideMe(sliderViewItems, isActiveItem);
}




// triggers arrows
arrowRight.addEventListener('click', () => beforeSliding(1));
arrowLeft.addEventListener('click', () => beforeSliding(0));