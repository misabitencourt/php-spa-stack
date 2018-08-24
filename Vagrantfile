# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure("2") do |config|

    config.vm.box = "scotch/box"
    config.vm.network 'forwarded_port', guest: 80, host: 8080
    config.vm.network 'forwarded_port', guest: 3306, host: 3307
    config.vm.network 'private_network', ip: '33.33.33.10'
    config.vm.synced_folder "./", "/var/www", :mount_options => ["dmode=777", "fmode=666"]
    
    # Optional NFS. Make sure to remove other synced_folder line too
    #config.vm.synced_folder ".", "/var/www", :nfs => { :mount_options => ["dmode=777","fmode=666"] }
end
