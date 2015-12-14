# -*- mode: ruby -*-
# vi: set ft=ruby :

VAGRANTFILE_API_VERSION = "2"

Vagrant.configure(VAGRANTFILE_API_VERSION) do |config|

  config.vm.box = "ubuntu/trusty32"
  config.vm.network "forwarded_port", guest: 80, host: 8888 
  config.vm.network "private_network", ip: "192.168.33.10" 
  config.vm.synced_folder "htdocs", "/var/www/html"
  config.vm.provision "shell", path: "config.sh"
  
end
