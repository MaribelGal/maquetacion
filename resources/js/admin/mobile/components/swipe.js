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
        let swipeElement = swipeConfig.swipeElement;
		let swipeFrontElement = swipeConfig.swipeFrontElement;

		let itemDimension = axis == "x" ? swipeFrontElement.clientWidth : swipeFrontElement.clientHeight;

		let slopValue = itemDimension * swipeConfig.slopRatio;

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

			swipeFrontElement.style.transition = "initial";
		};

		this.handleGestureMove = function (evt) {
			evt.preventDefault();

			if (!initialTouchPos) {
				return;
			}

			lastTouchPos = getGesturePointFromEvent(evt);

			if (rafPending) {
				return;
			}

			rafPending = true;

			window.requestAnimFrame(onAnimFrame);
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

			console.log("AXIS: ", axis);

			updateSwipeRestPosition();

			initialTouchPos = null;
		};

		function updateSwipeRestPosition() {
			let differenceInX = initialTouchPos.x - lastTouchPos.x;
			let differenceInY = initialTouchPos.y - lastTouchPos.y;

			let newState = STATE_DEFAULT;

			let differenceInAxis = axis == "x" ? differenceInX : differenceInY;

			currentAxisPosition = currentAxisPosition - differenceInAxis;

			console.log(differenceInAxis);

			newState = triggerState(differenceInAxis);

			changeState(newState);

			swipeFrontElement.style.transition = "all 150ms ease-out";
		}

		function triggerState(differenceInAxis) {
			console.log("trigger");
			console.log(currentState);
			let newState = STATE_DEFAULT;

			if (isStateDefault(differenceInAxis)) {
				console.log("state default");
				newState = STATE_DEFAULT;
			}

			if (currentState === STATE_DEFAULT) {
				if (differenceInAxis > 0 && isStateLeftOrTop(differenceInAxis)) {
					console.log("state left top");
					newState = STATE_LEFT_TOP_SIDE;
				}
				if (differenceInAxis < 0 && isStateRightOrBottom(differenceInAxis)) {
					console.log("state right botom");
					newState = STATE_RIGHT_BOTTOM_SIDE;
				}
			}

			return newState;
		}

		function isStateLeftOrTop(differenceInAxis) {
			let booleanLeftTop = false;

			if (swipeConfig.limitRatio_LeftOrTop < 1) {
				if (Math.abs(differenceInAxis) > Math.abs(limitLeftOrTop)) {
					booleanLeftTop = true;
					console.log("limit left");
				}
			} else if (Math.abs(differenceInAxis) > slopValue) {
				booleanLeftTop = true;
				console.log("slop");
			}

			return booleanLeftTop;
		}

		function isStateRightOrBottom(differenceInAxis) {
			let booleanRightOrBottom = false;
			if (swipeConfig.limitRatio_RightOrBottom < 1) {
				if (Math.abs(differenceInAxis) > Math.abs(limitRightOrBottom)) {
					booleanRightOrBottom = true;
					console.log("limit right");
				}
			} else if (Math.abs(differenceInAxis) > slopValue) {
				booleanRightOrBottom = true;
				console.log("slop");
			}

			return booleanRightOrBottom;
		}

		function isStateDefault(differenceInAxis) {
			let booleanDefault = false;
			if (Math.abs(differenceInAxis) > slopValue) {
				if (currentState === STATE_LEFT_TOP_SIDE && differenceInAxis > 0) {
					booleanDefault = true;
				} else if (currentState === STATE_RIGHT_BOTTOM_SIDE && differenceInAxis < 0) {
					booleanDefault = true;
				}
			}
			return booleanDefault;
		}

		function changeState(newState) {
            if (swipeConfig.bouncyActive)
			switch (newState) {
				case STATE_DEFAULT:
                    if (swipeConfig.bouncyActive) {
                        currentAxisPosition = 0
                    }  
					currentState = newState;
					break;
				case STATE_LEFT_TOP_SIDE:
                    if (swipeConfig.bouncyActive) {
                        currentAxisPosition = -(itemDimension - handleSizeLeftOrTop);
                    }  
					
					swipeConfig.actionLeftOrTopState();
					itemDimension == handleSizeLeftOrTop ? (currentState = STATE_DEFAULT) : (currentState = newState);
					break;
				case STATE_RIGHT_BOTTOM_SIDE:
                    if (swipeConfig.bouncyActive) {
                        currentAxisPosition = itemDimension - handleSizeRightOrBottom;
                    }  
					
					swipeConfig.actionRightOrBottomState();
					itemDimension == handleSizeRightOrBottom ? (currentState = STATE_DEFAULT) : (currentState = newState);
					break;
			}

			swipeConfig.applyStyle(currentAxisPosition, swipeFrontElement);
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

			// if (differenceInAxis < 0 && !backLeftOrTopVisible) {
			// 	swipeConfig.actionLeftOrTopBackVisible();
			// 	backLeftOrTopVisible = true;
			// 	backRightOrBottomVisible = false;
			// } else if (differenceInAxis > 0 && !backRightOrBottomVisible) {
			// 	swipeConfig.actionRightOrBottomBackVisible();
			// 	backLeftOrTopVisible = false;
			// 	backRightOrBottomVisible = true;
			// }

            backvisible()

			if (-limitRightOrBottom < differenceInAxis && -limitLeftOrTop < -differenceInAxis) {
				let newXTransform = currentAxisPosition - differenceInAxis;
				swipeConfig.applyStyle(newXTransform, swipeFrontElement);
			}

			rafPending = false;
		}

        //TODO: con el bounding 
        function backvisible() {

            if (differenceInAxis < 0 && !backLeftOrTopVisible) {
				swipeConfig.actionLeftOrTopBackVisible();
				backLeftOrTopVisible = true;
				backRightOrBottomVisible = false;
			} else if (differenceInAxis > 0 && !backRightOrBottomVisible) {
				swipeConfig.actionRightOrBottomBackVisible();
				backLeftOrTopVisible = false;
				backRightOrBottomVisible = true;
			}


        }

		if (window.PointerEvent) {
			swipeFrontElement.addEventListener("pointerdown", this.handleGestureStart, true);
			swipeFrontElement.addEventListener("pointermove", this.handleGestureMove, true);
			swipeFrontElement.addEventListener("pointerup", this.handleGestureEnd, true);
			swipeFrontElement.addEventListener("pointercancel", this.handleGestureEnd, true);
		} else {
			swipeFrontElement.addEventListener("touchstart", this.handleGestureStart, true);
			swipeFrontElement.addEventListener("touchmove", this.handleGestureMove, true);
			swipeFrontElement.addEventListener("touchend", this.handleGestureEnd, true);
			swipeFrontElement.addEventListener("touchcancel", this.handleGestureEnd, true);

			swipeFrontElement.addEventListener("mousedown", this.handleGestureStart, true);
		}
	}

	resize(swipeFrontElement) {
		this.itemDimension = swipeFrontElement.clientWidth;
		this.slopValue = this.itemDimension * (1 / 4);
	}
}