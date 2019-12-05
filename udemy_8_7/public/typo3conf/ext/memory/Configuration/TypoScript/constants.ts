
plugin.tx_memory_game {
    view {
        # cat=plugin.tx_memory_game/file; type=string; label=Path to template root (FE)
        templateRootPath = EXT:memory/Resources/Private/Templates/
        # cat=plugin.tx_memory_game/file; type=string; label=Path to template partials (FE)
        partialRootPath = EXT:memory/Resources/Private/Partials/
        # cat=plugin.tx_memory_game/file; type=string; label=Path to template layouts (FE)
        layoutRootPath = EXT:memory/Resources/Private/Layouts/
    }
    persistence {
        # cat=plugin.tx_memory_game//a; type=string; label=Default storage PID
        storagePid =
    }
}

module.tx_memory_highscore {
    view {
        # cat=module.tx_memory_highscore/file; type=string; label=Path to template root (BE)
        templateRootPath = EXT:memory/Resources/Private/Backend/Templates/
        # cat=module.tx_memory_highscore/file; type=string; label=Path to template partials (BE)
        partialRootPath = EXT:memory/Resources/Private/Backend/Partials/
        # cat=module.tx_memory_highscore/file; type=string; label=Path to template layouts (BE)
        layoutRootPath = EXT:memory/Resources/Private/Backend/Layouts/
    }
    persistence {
        # cat=module.tx_memory_highscore//a; type=string; label=Default storage PID
        storagePid =
    }
}
