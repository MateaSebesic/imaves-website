# imaves-website

Instructions for Setting up SSH connection and cloning  

Navigate to cPanel’s SSH Access interface undet Security tab  

1. Click Manage SSH Keys.
2. Click View/Download both Public Key & Private Key 
3. Save downloaded files in `~/.ssh`

Configure your .ssh/config file  
```bash
Host imaves
    HostName imaves.hr
    Port 23132
    User imaveshr
    IdentityFile ~/.ssh/id_rsa
```

Passphrase is located under `\\imaves.hr\IMAVES - Documents\Profesionalne usluge\Održavanje\Imaves IT\KeePass\Ostalo\hosting.kdbx`  

Check if ssh is connected to GitHub repo and new changes are pulled from it before changes are made.  
```bash
$ cd www
$ ssh -vT git@github.com
$ git -c user.name='Your name' -c user.email=Your@emailaddres.com pull
```
After everything is up to latest update and patched continue on the making changes/tasks  

To commit changes to imaves-website repo  
You need to run the following commands:
```git
$ git add .
$ git -c user.name='Your name' -c user.email=Your@emailaddres.com commit -m "msg"
$ git push -u origin main
```
