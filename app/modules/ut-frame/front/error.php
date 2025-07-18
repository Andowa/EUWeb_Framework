<?php
use library\EuFrameDebug\EUDebug;
EUDebug::Error("module",str_replace(APP_ROOT."/modules","",$modfile));