/* // [START pointereventsupport] */
let pointerDownName = "pointerdown";
let pointerUpName = "pointerup";
let pointerMoveName = "pointermove";

if (window.navigator.msPointerEnabled) {
	pointerDownName = "MSPointerDown";
	pointerUpName = "MSPointerUp";
	pointerMoveName = "MSPointerMove";
}

// Simple way to check if some form of pointerevents is enabled or not
window.PointerEventsSupport = false;
if (window.PointerEvent || window.navigator.msPointerEnabled) {
	window.PointerEventsSupport = true;
}
/* // [END pointereventsupport] */

export class SwipeRevealItem {
	constructor(swipeConfig) {
		let axis = swipeConfig.axis;
		let swipeContainer = swipeConfig.swipeContainer;
		let swipeContent = swipeConfig.swipeContent;

		let itemDimension = axis == "x" ? swipeContent.clientWidth : swipeContent.clientHeight;

		let slopValue = itemDimension * swipeConfig.slopRatio;
		let slopToLeftOrTop = swipeConfig.slopToLeftOrTop;
		let slopToRightOrBottom = swipeConfig.slopToRightOrBottom;

		let handleSizeLeftOrTop = itemDimension * swipeConfig.handleSizeRatio_LeftOrTop;
		let handleSizeRightOrBottom = itemDimension * swipeConfig.handleSizeRatio_RightOrBottom;

		let limitRightOrBottom = itemDimension * swipeConfig.limitRatio_RightOrBottom;
		let limitLeftOrTop = itemDimension * swipeConfig.limitRatio_LeftOrTop;

		let STATE_DEFAULT = 1;
		let STATE_LEFT_TOP_SIDE = 2;
		let STATE_RIGHT_BOTTOM_SIDE = 3;

		let backLeftOrTopVisible = false;
		let backRightOrBottomVisible = false;

		let rafPending = false;

		let initialTouchPos = null;
		let lastTouchPos = null;

		let containerBounding = swipeContainer.getBoundingClientRect();
		let initialContentBounding = null;
		let lastContentBounding = null;

		let currentXPosition = 0;
		let currentYPosition = 0;
		let currentAxisPosition = axis == "x" ? currentXPosition : currentYPosition;

		let currentState = STATE_DEFAULT;

		this.handleGestureStart = function (evt) {
			evt.preventDefault();

			if (evt.touches && evt.touches.length > 1) {
				return;
			}

			if (window.PointerEvent) {
				evt.target.setPointerCapture(evt.pointerId);
			} else {
				document.addEventListener("mousemove", this.handleGestureMove, true);
				document.addEventListener("mouseup", this.handleGestureEnd, true);
			}

			initialTouchPos = getGesturePointFromEvent(evt);
			initialContentBounding = swipeContent.getBoundingClientRect();

			swipeContent.style.transition = "initial";
		};

		this.handleGestureMove = function (evt) {
			evt.preventDefault();

			if (!initialTouchPos) {
				return;
			}

			lastTouchPos = getGesturePointFromEvent(evt);
			lastContentBounding = swipeContent.getBoundingClientRect();

			if (rafPending) {
				return;
			}

			rafPending = true;

			window.requestAnimFrame(onAnimFrame);

			getBounding();
		};

		this.handleGestureEnd = function (evt) {
			evt.preventDefault();

			if (evt.touches && evt.touches.length > 0) {
				return;
			}

			rafPending = false;

			if (window.PointerEvent) {
				evt.target.releasePointerCapture(evt.pointerId);
			} else {
				document.removeEventListener("mousemove", this.handleGestureMove, true);
				document.removeEventListener("mouseup", this.handleGestureEnd, true);
			}

			updateSwipeRestPosition();

			initialTouchPos = null;
			initialContentBounding = null;
		};

		function updateSwipeRestPosition() {
			let newState = STATE_DEFAULT;

			let differenceInX = initialTouchPos.x - lastTouchPos.x;
			let differenceInY = initialTouchPos.y - lastTouchPos.y;
			let differenceInAxis = axis == "x" ? differenceInX : differenceInY;

			currentAxisPosition = currentAxisPosition - differenceInAxis;

			if (!swipeConfig.swipeMoveActive) {
				newState = selectStateByTouchMove(differenceInAxis);

			} else {
				let differenceInLeftOrTopLast = axis == "x" ? containerBounding.left - lastContentBounding.left : containerBounding.top - lastContentBounding.top;

				let differenceInRightOrBottomLast = axis == "x" ? containerBounding.right - lastContentBounding.right : containerBounding.bottom - lastContentBounding.bottom;

				let differenceInLeftOrTopInitial = axis == "x" ? containerBounding.left - initialContentBounding.left : containerBounding.top - initialContentBounding.top;

				let differenceInRightOrBottomInitial = axis == "x" ? containerBounding.right - initialContentBounding.right : containerBounding.bottom - initialContentBounding.bottom;

				// console.log("NO dlti "+  differenceInLeftOrTopInitial );
				// console.log("drbi "+  differenceInRightOrBottomInitial );
				// console.log("NO dltl "+  differenceInLeftOrTopLast );
				// console.log("drbl "+  differenceInRightOrBottomLast );


				newState = selectStateByPosition(
					differenceInLeftOrTopLast, 
					differenceInRightOrBottomLast,
					differenceInLeftOrTopInitial, 
					differenceInRightOrBottomInitial);


			}

			// console.log(newState);
			changeState(newState);

			swipeContent.style.transition = "all 150ms ease-out";
		}

		function selectStateByTouchMove(differenceInAxis) {
			let newState = STATE_DEFAULT;
			if (Math.abs(differenceInAxis) > swipeConfig.slopValue_unique) {
				if (currentState === STATE_DEFAULT) {
					if (differenceInX > 0) {
						newState = STATE_LEFT_TOP_SIDE;
					} else {
						newState = STATE_RIGHT_BOTTOM_SIDE;
					}
				} else {
					if (currentState === STATE_LEFT_TOP_SIDE && differenceInAxis > 0) {
						newState = STATE_DEFAULT;
					} else if (currentState === STATE_RIGHT_BOTTOM_SIDE && differenceInAxis < 0) {
						newState = STATE_DEFAULT;
					}
				}
			} else {
				newState = currentState;
			}
			return newState;
		}

		function selectStateByPosition(differenceInLeftOrTopLast, differenceInRightOrBottomLast,
			differenceInLeftOrTopInitial, differenceInRightOrBottomInitial) {
			let newState = STATE_DEFAULT;

			let isRightOrBottomVisibleLast = differenceInRightOrBottomLast > 0;
			let isLeftOrTopVisibleLast = differenceInLeftOrTopLast < 0;
			let isSlopRightOrBottomLast = Math.abs(differenceInLeftOrTopLast) > swipeConfig.slopToRigthOrBottom;
			let isSlopLeftOrTopLast = differenceInRightOrBottomLast > swipeConfig.slopToLeftOrTop;

			let toRightOrBottomLast = isLeftOrTopVisibleLast && isSlopRightOrBottomLast;
			let toLeftOrTopLast = (isRightOrBottomVisibleLast && isSlopLeftOrTopLast);


			newState = currentState;

			if (currentState === STATE_DEFAULT) {
				// console.log("actual state = default");
				if (toLeftOrTopLast) {
					// console.log("to left or top");
					newState = STATE_LEFT_TOP_SIDE;
				} else if (toRightOrBottomLast) {
					newState = STATE_RIGHT_BOTTOM_SIDE;
					// console.log(" to right or bottom");
				}
			}

			if ( currentState === STATE_LEFT_TOP_SIDE ){
				// console.log("actual state = left o top");
				if(differenceInRightOrBottomInitial > differenceInRightOrBottomLast) {
					// console.log("se aleja del limite superior");
					if (differenceInRightOrBottomLast < swipeConfig.slopToLeftOrTop) {
						newState = STATE_DEFAULT;
					}
				} else {
					// console.log("se acerca al limite sup");
					newState = currentState;
				}
			}

			if (currentState === STATE_RIGHT_BOTTOM_SIDE ){
				// console.log("actual state = right o bottom");
				if (differenceInLeftOrTopInitial > differenceInLeftOrTopLast) {
					// console.log("se aleja del limite superior");
					newState = currentState;
				} else {
					// console.log("se acerca al limite sup");
					// console.log(differenceInLeftOrTopLast);
					// console.log(swipeConfig.slopToRigthOrBottom);
					if (Math.abs(differenceInLeftOrTopLast) < swipeConfig.slopToRigthOrBottom){
						newState = STATE_DEFAULT;
					}
				}
			}


			return newState;
		}

		function changeState(newState) {
			let fixedRigthBottom;
			let fixedLeftTop;
			let styleParameter;

			switch (newState) {
				case STATE_DEFAULT:
					// console.log("cambiar estado a DEFAULT");
					if (currentState === STATE_RIGHT_BOTTOM_SIDE && swipeConfig.handleSizeRatio_RightOrBottom < 1){
						currentAxisPosition = 0;
						styleParameter = currentAxisPosition;
					}

					if (currentState === STATE_LEFT_TOP_SIDE && swipeConfig.handleSizeRatio_LeftOrTop < 1){
						fixedRigthBottom = axis == "x" ? containerBounding.width - lastContentBounding.width : containerBounding.height - lastContentBounding.height;
						styleParameter = fixedRigthBottom;
					}
					if (currentState === STATE_DEFAULT) {
						styleParameter = currentAxisPosition;
					}
					
					currentState = newState;
					break;
				case STATE_LEFT_TOP_SIDE:
					swipeConfig.actionLeftOrTopState();

					if (itemDimension == handleSizeLeftOrTop) {
						fixedRigthBottom = axis == "x" ? containerBounding.width - lastContentBounding.width : containerBounding.height - lastContentBounding.height;
						styleParameter = fixedRigthBottom;
						currentAxisPosition = fixedRigthBottom;
						currentState = STATE_DEFAULT;
					} else {
						currentAxisPosition = -(itemDimension - handleSizeLeftOrTop);
						styleParameter = currentAxisPosition;
						currentState = newState;
					}
					break;

				case STATE_RIGHT_BOTTOM_SIDE:
					swipeConfig.actionRightOrBottomState();

					if (itemDimension == handleSizeRightOrBottom) {
						currentAxisPosition = 0;
						fixedLeftTop = 0;
						styleParameter = fixedLeftTop;
						currentState = STATE_DEFAULT;
					} else {
						currentAxisPosition = itemDimension - handleSizeRightOrBottom;
						styleParameter = currentAxisPosition;
						currentState = newState;
					}
					break;
			}

			// console.log('estilo: '+styleParameter);
			swipeConfig.applyStyle(styleParameter, swipeContent);
			// console.log(currentState);
		}

		function getGesturePointFromEvent(evt) {
			let point = {};
			if (evt.targetTouches) {
				point.x = evt.targetTouches[0].clientX;
				point.y = evt.targetTouches[0].clientY;
			} else {
				point.x = evt.clientX;
				point.y = evt.clientY;
			}
			return point;
		}

		function onAnimFrame() {
			if (!rafPending) {
				return;
			}

			let differenceInX = initialTouchPos.x - lastTouchPos.x;
			let differenceInY = initialTouchPos.y - lastTouchPos.y;
			let differenceInAxis = axis == "x" ? differenceInX : differenceInY;

			// console.log("differenceInX "+ differenceInX);
			// console.log("differenceInY "+ differenceInY);
			// console.log("differenceInAxis "+ differenceInAxis);

			if (-limitRightOrBottom < differenceInAxis && -limitLeftOrTop < -differenceInAxis) {
				let newXTransform = currentAxisPosition - differenceInAxis;
				// console.log("aplicar estilo onAnimFrame: "+ newXTransform);
				// console.log("aplicar estilo onAnimFrame:  (currentAxispos) "+ currentAxisPosition);
				swipeConfig.applyStyle(newXTransform, swipeContent);
			}

			rafPending = false;
		}

		function getBounding() {
			let containerBounding = swipeContainer.getBoundingClientRect();
			let childBounding = swipeContent.getBoundingClientRect();

			let differenceInLeftOrTopLast = axis == "x" ? containerBounding.left - childBounding.left : containerBounding.top - childBounding.top;

			let differenceInRightOrBottomLast = axis == "x" ? containerBounding.right - childBounding.right : containerBounding.bottom - childBounding.bottom;

			if (differenceInLeftOrTopLast < 0 && !backLeftOrTopVisible) {
				swipeConfig.actionLeftOrTopBackVisible();
				backLeftOrTopVisible = true;
				backRightOrBottomVisible = false;
			}

			if (differenceInRightOrBottomLast > 0 && !backRightOrBottomVisible) {
				swipeConfig.actionRightOrBottomBackVisible();
				backLeftOrTopVisible = false;
				backRightOrBottomVisible = true;
			}
		}

		if (window.PointerEvent) {
			swipeContent.addEventListener("pointerdown", this.handleGestureStart, true);
			swipeContent.addEventListener("pointermove", this.handleGestureMove, true);
			swipeContent.addEventListener("pointerup", this.handleGestureEnd, true);
			swipeContent.addEventListener("pointercancel", this.handleGestureEnd, true);
		} else {
			swipeContent.addEventListener("touchstart", this.handleGestureStart, true);
			swipeContent.addEventListener("touchmove", this.handleGestureMove, true);
			swipeContent.addEventListener("touchend", this.handleGestureEnd, true);
			swipeContent.addEventListener("touchcancel", this.handleGestureEnd, true);

			swipeContent.addEventListener("mousedown", this.handleGestureStart, true);
		}
	}

	resize(swipeContent) {
		this.itemDimension = swipeContent.clientWidth;
		this.slopValue = this.itemDimension * (1 / 4);
	}
}