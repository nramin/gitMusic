

		soundManager.setup({
		  // path to directory containing SM2 SWF
		  url: '/assets/swf/'
		});

		threeSixtyPlayer.config.scaleFont = (navigator.userAgent.match(/msie/i)?false:true);
		threeSixtyPlayer.config.showHMSTime = true;

		// enable some spectrum stuffs

		threeSixtyPlayer.config.useWaveformData = false;
		threeSixtyPlayer.config.useEQData = true;

		// enable this in SM2 as well, as needed

		if (threeSixtyPlayer.config.useWaveformData) {
		  soundManager.flash9Options.useWaveformData = false;
		}
		if (threeSixtyPlayer.config.useEQData) {
		  soundManager.flash9Options.useEQData = true;
		}
		if (threeSixtyPlayer.config.usePeakData) {
		  soundManager.flash9Options.usePeakData = true;
		}

		// favicon is expensive CPU-wise, but can be used.
		if (window.location.href.match(/hifi/i)) {
		  threeSixtyPlayer.config.useFavIcon = true;
		}

		if (window.location.href.match(/html5/i)) {
		  // for testing IE 9, etc.
		  soundManager.useHTML5Audio = true;
		}