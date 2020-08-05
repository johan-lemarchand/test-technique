btn = document.getElementById('anim_explorer');

const animation = bodymovin.loadAnimation({
		container: document.getElementById('anim_explorer'),
		renderer: 'svg',
		loop: false,
		autoplay: false,
		path: 'explorer_img.json'
});
const directionMenu = 1;
btn.addEventListener('mouseenter', (e) => {
		animation.setDirection(directionMenu);
		animation.play();
});

btn.addEventListener('mouseleave', (e) => {
		animation.setDirection(-directionMenu);
		animation.play();
});




