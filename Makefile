

default: up

build up down fclean:
	$(MAKE) -C runtime $@
